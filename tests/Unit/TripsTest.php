<?php

namespace Tests\Unit;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function trip_has_is_active_method()
    {
        $trip = factory(Trip::class)->create();
        $this->assertTrue($trip->isActive());
        $trip->update([
            'completed_at' => Carbon::now(),
        ]);
        $this->assertFalse($trip->isActive());
    }

    /** @test */
    public function trip_has_transit_days()
    {
        $tripDays = 5;
        $today = Carbon::today();
        $previousDays = Carbon::today()->subDays($tripDays);
        $trip = factory(Trip::class)->create([
            'started_at' => $previousDays,
            'completed_at' => $today,
        ]);
        $this->assertEquals($trip->trip_days, $tripDays);
    }

}
