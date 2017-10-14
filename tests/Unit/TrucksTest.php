<?php

namespace Tests\Unit;

use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrucksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function truckHasAnActiveTrip()
    {
        $truck = factory(Truck::class)->create();
        $truck->createTrip('12-12-2017 12:00 AM');
        $this->assertNotNull($truck->activeTrip);
    }

    /** @test */
    public function truckCanCreateTrip()
    {
        $truck = factory(Truck::class)->create();
        $truck->createTrip('12-12-2017 12:00 AM');
        $this->assertEquals($truck->trips()->count(), 1);
    }

    /** @test */
    public function truckCanCreateTripIfNoActiveTripsAreAvailable()
    {
        $truck = factory(Truck::class)->create();
        $truck->createTrip('12-12-2017 12:00 AM');
        $this->assertEquals($truck->trips()->count(), 1);
        $truck->createTrip('12-12-2017 12:00 AM');
        $this->assertEquals($truck->trips()->count(), 1);
    }

}
