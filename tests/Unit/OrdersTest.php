<?php

namespace Tests\Unit;

use App\Models\Trips\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function orders_has_id()
    {
        $order = factory(Order::class)->create();
        $this->assertTrue($order->id() == 'O#' . $order->id);
    }

    /** @test */
    public function order_has_material()
    {
        $cargo = "pallets";
        $weight = 14;
        $order = factory(Order::class)->create([
            'cargo' => $cargo,
            'weight' => $weight,
        ]);
        $this->assertTrue($order->material() == "{$cargo} - {$weight} MT");
    }
}
