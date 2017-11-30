<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequirementsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function requirementsAreCreatedToTrucksWithActiveTrip()
    {
        $this->signIn();
        $trip = factory(Trip::class)->create();
        $account = factory(Account::class)->create();
        $this->assertEquals($trip->ledgers()->count(), 0);
        $this->withoutExceptionHandling();
        $this->post("requirements", [
            'truck_id' => $trip->truck_id,
            'amount' => '100',
            'reason' => "Reason",
            'type' => $account->id,
        ]);
        $this->assertEquals($trip->ledgers()->count(), 1);
    }

    /** @test */
    public function anActiveTripIsCreatedIfNoActiveTripsExist()
    {
        $this->signIn();
        $truck = factory(Truck::class)->create();
        $account = factory(Account::class)->create();
        $this->assertEquals(Ledger::count(), 0);
        $this->post("requirements", [
            'truck_id' => $truck->id,
            'amount' => '100',
            'reason' => "Reason",
            'type' => $account->id,
        ]);
        $this->assertEquals(Ledger::count(), 1);

    }
}
