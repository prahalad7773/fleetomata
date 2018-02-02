<?php

namespace Tests\Unit;

use App\Models\Trip;
use App\Models\Trips\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tripHasIsActiveMethod()
    {
        $trip = factory(Trip::class)->create();
        $this->assertTrue($trip->isActive());
        $trip->update([
            'completed_at' => Carbon::now(),
        ]);
        $this->assertFalse($trip->isActive());
    }

    /** @test */
    public function tripDaysIncludesEmptyAndTransitDays()
    {
        $now = Carbon::createFromFormat('d-m-Y g:i A', '15-07-1993 12:00 AM');
        Carbon::setTestNow($now);
        $trip = factory(Trip::class)->create([
            'started_at' => Carbon::createFromFormat('d-m-Y g:i A', '10-07-1993 12:00 AM'),
        ]);
        $orderA = factory(Order::class)->create([
            'trip_id' => $trip->id,
            'when' => '13-07-1993 12:00 AM',
        ]);
        $orderB = factory(Order::class)->create([
            'trip_id' => $trip->id,
            'when' => '15-07-1993 12:00 AM',
        ]);
        //transit day (empty day)
        $this->assertEquals(sprintf("%s(%s)", 2, 3), $trip->trip_days);
    }

}
