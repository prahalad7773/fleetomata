<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrucksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userCanCreateANewTruck()
    {
        $this->signIn();
        $data = [
            'number' => 'TN02 AX4446',
            'type' => '32ft Container',
        ];
        $this->post('/trucks', $data);
        $this->assertDatabaseHas('trucks', $data);
    }

    /** @test */
    public function userCanFilterByTruckTrips()
    {
        $this->signIn();
        $truck = factory(Truck::class)->create();
        $tripA = factory(Trip::class)->create([
            'truck_id' => $truck->id,
            'started_at' => Carbon::today(),
        ]);
        $tripB = factory(Trip::class)->create([
            'truck_id' => $truck->id,
            'started_at' => Carbon::today()->addDays(3),
        ]);
        $url = sprintf("trucks/%s?type=trips&start=%s&end=%s",
            $truck->id,
            Carbon::yesterday()->format('d-m-Y'),
            Carbon::tomorrow()->format('d-m-Y')
        );
        $response = $this->get($url)->assertStatus(200);
    }

}
