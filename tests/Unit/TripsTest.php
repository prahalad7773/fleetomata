<?php

namespace Tests\Unit;

use App\Models\Trip;
use App\Models\Trips\Account;
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
        $to = Account::create(['name' => 'JSM HQ']);
        $ledger = factory(Ledger::class)->create([
            'trip_id' => $trip->id,
            'fromable_id' => $order->customer_id,
            'fromable_type' => 'App\Models\Trips\Customer',
            'toable_id' => $to->id,
            'toable_type' => get_class($to),
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
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
            'trip_id' => $trip->id,
            'amount' => $amount,
        ]);
        $this->assertEquals($trip->financeSummary()->expense, $amount);
    }

    /** @test */
    public function trip_has_transit_days()
    {
        $tripDays = 5;
        $today = Carbon::today();
        $previousDays = Carbon::today()->subDays($tripDays);
        $trip = factory(Trip::class)->create([
            'started_at' => $previousDays,
        ]);

        $this->assertEquals($trip->tripDays(), $tripDays);
    }
}
