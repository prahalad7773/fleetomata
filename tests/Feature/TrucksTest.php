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
}
