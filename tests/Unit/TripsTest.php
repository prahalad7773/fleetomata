<?php

namespace Tests\Unit;

use App\Models\Trip;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
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
    public function trip_has_balance()
    {
        $hire = 100;
        $amount = 80;
        $trip = factory(Trip::class)->create();
        $order = factory(Order::class)->create([
            'trip_id' => $trip->id,
            'hire' => $hire,
        ]);
        $ledger = factory(Ledger::class)->create([
            'trip_id' => $trip->id,
            'fromable_id' => $order->customer_id,
            'fromable_type' => 'App\Models\Trips\Customer',
            'amount' => $amount,
        ]);
        $this->assertEquals($trip->financeSummary()->balance(), $hire - $amount);
    }

    /** @test */
    public function trip_has_total_expense()
    {
        $amount = 100;
        $trip = factory(Trip::class)->create();
        $order = factory(Order::class)->create([
            'trip_id' => $trip->id,
        ]);
        $ledger = factory(Ledger::class)->create([
            'trip_id' => $trip->id,
            'amount' => $amount,
        ]);
        $this->assertEquals($trip->financeSummary()->expense, $amount);
    }
}
