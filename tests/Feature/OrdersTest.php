<?php

namespace Tests\Feature;

use App\Models\Trips\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function adminsCanDeleteOrders()
    {
        $user = $this->signIn();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
        $order = factory(Order::class)->create();
        $this->assertDatabaseHas('orders', ['id' => $order->id]);
        $this->delete("trips/{$order->trip_id}/orders/{$order->id}");
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    /** @test */
    public function nonAdminsCannotDeleteOrders()
    {
        $user = $this->signIn();
        $order = factory(Order::class)->create();
        $this->assertDatabaseHas('orders', ['id' => $order->id]);
        $this->delete("trips/{$order->trip_id}/orders/{$order->id}");
        $this->assertDatabaseHas('orders', ['id' => $order->id]);
    }
}
