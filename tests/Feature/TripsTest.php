<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Truck;
use App\Trips\Customer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_add_trips_to_a_truck()
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
    public function user_can_add_order_to_trip()
    {
        $customer_name = 'JSM Logistics';
        $customer_phone = '9444904811';
        $this->assertEquals(Customer::count(), 0);
        $this->signIn();
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
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
        ]);
        $this->assertEquals($trip->orders()->count(), 1);
        $this->assertEquals(Customer::count(), 1);
    }
}
