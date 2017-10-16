<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Truck;
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
        ]);
        $this->assertEquals($trip->orders()->count(), 1);
    }
}
