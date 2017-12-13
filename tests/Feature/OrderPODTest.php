<?php

namespace Tests\Feature;

use App\Models\Trips\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPODTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userCanUpdateOrderStatus()
    {
        $this->signIn();
        $order = factory(Order::class)->create();
        $status = "POD Received";
        $this->assertNull($order->pod_status);
        $this->patch("/trips/orders/pods/{$order->id}", [
            'pod_status' => $status,
        ]);
        $this->assertEquals($order->fresh()->pod_status, $status);
    }
}
