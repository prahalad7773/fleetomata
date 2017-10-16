<?php

namespace App\Models;

use App\Models\BaseModel;
use GuzzleHttp\Client;

class Location extends BaseModel
{

    public static function createFromPlaceID($placeID)
    {
        $location = Location::where('place_id', $placeID)->first();
        return $location ?? (new static )->createLocation($placeID);
    }

    public function createLocation($placeID)
    {
        $location = new static;
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
        $location->place_id = $placeID;
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

    public static function distanceBetween(Location $location1, Location $location2)
    {
        $client = new Client();
        $key = env('GOOGLE_API_KEY');
        $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?origins=place_id:{$location1->place_id}&destinations=place_id:{$location2->place_id}&key={$key}");
        return (json_decode(($response->getBody()->getContents()), true))['rows'][0]['elements']['0']['distance']['value'] / 1000;
    }
}
