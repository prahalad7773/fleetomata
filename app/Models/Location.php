<?php

namespace App\Models;

use App\Models\BaseModel;

class Location extends BaseModel
{

    public static function createFromPlaceID($placeID)
    {
        $location = (new static );
        $google = \GooglePlaces::placeDetails($placeID);
        foreach ($google['result']['address_components'] as $result) {
            $type = $location->getLocationType($result['types'][0]);
            if ($type) {
                $location->$type = $result['long_name'];
            }
        }
        $location->lat = $google['result']['geometry']['location']['lat'];
        $location->lng = $google['result']['geometry']['location']['lng'];
        $location->formatted_address = $google['result']['formatted_address'];
        return self::firstOrCreate($location->toArray());
    }

    public function getLocationType($type)
    {
        switch ($type) {
            case 'administrative_area_level_2':
                return 'district';
            case 'administrative_area_level_1':
                return 'state';
            case 'postal_code':
                return 'postal_code';
            case 'locality':
                return 'locality';
        }
    }
}
