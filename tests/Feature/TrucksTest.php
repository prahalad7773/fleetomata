<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrucksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_create_a_new_truck()
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
