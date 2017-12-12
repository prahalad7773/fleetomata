<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
use App\Models\Truck;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userCanAddTripsToATruck()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $truck = factory(Truck::class)->create();
        $time = '12-12-2017 12:00 AM';
        $this->post("/trips", [
            'truck_id' => $truck->id,
            'started_at' => $time,
        ]);
        $this->assertEquals($truck->trips->count(), 1);
        $this->assertEquals($truck->trips->first()->started_at, Carbon::createFromFormat('d-m-Y g:i A', $time));
    }

    /** @test */
    public function userCanAddOrderToTrip()
    {
        $this->signIn();
        $this->withoutEvents();
        $trip = factory(Trip::class)->create();
        $this->withoutExceptionHandling();
        $this->assertEquals($trip->orders()->count(), 0);
        $this->post("trips/{$trip->id}/orders", [
            'loading_place_id' => 'ChIJbWWE8SxhUjoR9jE5PIQLVhE',
            'unloading_place_id' => 'ChIJbWWE8SxhUjoR9jE5PIQLVhE',
            'cargo' => 'Pallets',
            'weight' => '14',
            'hire' => '25000',
            'when' => '12-12-2017 12:00 AM',
            'type' => 1,
            'remarks' => 'Hello world',
        ]);
        $this->assertEquals($trip->orders()->count(), 1);
    }

    /** @test */
    public function userCannotAddOrdersToATripWhichIsClosed()
    {
        $customer_name = 'JSM Logistics';
        $customer_phone = '9444904811';
        $this->signIn();
        $trip = factory(Trip::class)->create([
            'completed_at' => Carbon::now(),
        ]);
        $this->assertEquals($trip->orders()->count(), 0);
        $this->post("trips/{$trip->id}/orders", [
            'loading_place_id' => 'ChIJbWWE8SxhUjoR9jE5PIQLVhE',
            'unloading_place_id' => 'ChIJbWWE8SxhUjoR9jE5PIQLVhE',
            'cargo' => 'Pallets',
            'weight' => '14',
            'hire' => '25000',
            'when' => '12-12-2017 12:00 AM',
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
        ]);
        $this->assertEquals($trip->orders()->count(), 0);
    }

    /** @test */
    public function tripsCanBeCompleted()
    {
        $this->signIn();
        $trip = factory(Trip::class)->create();
        $this->assertNull($trip->completed_at);
        $this->put("trips/{$trip->id}", [
            'completed_at' => '12-12-2017 12:00 AM',
        ]);
        $this->assertNotNull($trip->fresh()->completed_at);
    }

    /** @test */
    public function adminUserCanDeleteTrips()
    {
        $user = factory(User::class)->create([
            'email' => 'itsme@theyounus.com',
        ]);
        $this->signIn($user);
        $trip = factory(Trip::class)->create();
        $order = factory(Order::class)->create([
            'trip_id' => $trip->id,
        ]);
        list($from, $to) = factory(Account::class, 2)->create();
        $ledger = factory(Ledger::class)->create([
            'trip_id' => $trip->id,
            'fromable_id' => $from->id,
            'fromable_type' => get_class($from),
            'toable_id' => $to->id,
            'toable_type' => get_class($to),
        ]);
        $this->assertEquals(Trip::all()->count(), 1);
        $this->assertEquals(Ledger::all()->count(), 1);
        $this->assertEquals(Order::all()->count(), 1);
        $this->delete("trips/{$trip->id}");
        $this->assertEquals(Trip::all()->count(), 0);
        $this->assertEquals(Ledger::all()->count(), 0);
        $this->assertEquals(Order::all()->count(), 0);
    }

    /** @test */
    public function nonAdminsCantDeleteTrips()
    {
        $this->signIn();
        $trip = factory(Trip::class)->create();
        $this->assertEquals(1, Trip::all()->count());
        $this->delete("trips/{$trip->id}");
        $this->assertEquals(1, Trip::all()->count());
    }
}
