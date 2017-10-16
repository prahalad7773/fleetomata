<?php

namespace Tests\Unit;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function location_can_be_created_from_place_id()
    {
        $placeID = 'ChIJbWWE8SxhUjoR9jE5PIQLVhE';
        $location = Location::createFromPlaceID($placeID);
        $this->assertTrue($location->formatted_address == 'Poochi Athipedu, Thiru Nagar, Valasaravakkam, Chennai, Tamil Nadu 600087, India');
        $this->assertTrue($location->state == 'Tamil Nadu');
        $this->assertTrue($location->district == 'Tiruvallur');
        $this->assertTrue($location->place_id == $placeID);
    }

    /** @test */
    public function multiple_locations_are_not_created()
    {
        $placeID = 'ChIJbWWE8SxhUjoR9jE5PIQLVhE';
        $location = Location::createFromPlaceID($placeID);
        $this->assertEquals(Location::count(), 1);
        $location = Location::createFromPlaceID($placeID);
        $this->assertEquals(Location::count(), 1);
    }

    // /** @test */
    // public function one_can_find_distance_between_two_locations()
    // {
    //     $placeID1 = new Location([
    //         'place_id' => 'ChIJbWWE8SxhUjoR9jE5PIQLVhE',
    //     ]);
    //     $placeID2 = new Location([
    //         'place_id' => 'ChIJMfcv2yBkUjoRq0eaEVucv-c',
    //     ]);
    //     $this->assertEquals(Location::distanceBetween($placeID1, $placeID2), 8638 / 1000);
    // }
}
