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

    }
}
