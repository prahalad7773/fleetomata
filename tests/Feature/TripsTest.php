<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripsTest extends TestCase
{
   	use RefreshDatabase;

    /** @test */
    function user_can_add_trips_to_a_truck()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $truck = factory(Truck::class)->create();
        $time = '12-12-2017 12:00 AM';
        $this->post("/trips",[
            'truck_id' => $truck->id,
            'started_at' => $time
        ]);
        $this->assertEquals($truck->trips->count(), 1);
        $this->assertEquals($truck->trips->first()->started_at, Carbon::createFromFormat('d-m-Y g:i A', $time));
    }
}
