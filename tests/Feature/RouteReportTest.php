<?php

namespace Tests\Feature;

use App\Models\Trips\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteReportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function routeReportReturnsListOfRoutes()
    {
        $this->signIn();
        $order = factory(Order::class)->create();
        $orderB = factory(Order::class)->create();
        $this->get("route-report?source={$order->loading_point_id}&destination={$order->unloading_point_id}")
            ->assertSee($order->id())
            ->assertNotSee($orderB->id());
    }
}
