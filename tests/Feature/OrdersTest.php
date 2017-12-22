<?php

namespace Tests\Feature;

use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
use Carbon\Carbon;
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

    /** @test */
    public function orderCanUpdateBalance()
    {
        $this->signIn();
        $amount = 100;
        $order = factory(Order::class)->create([
            'hire' => $amount,
            'pending_balance' => $amount,
        ]);
        $to = Account::create(['name' => 'BPCL']);
        Ledger::create([
            'trip_id' => $order->trip_id,
            'fromable_id' => $order->id,
            'fromable_type' => get_class($order),
            'toable_id' => $to->id,
            'toable_type' => get_class($to),
            'amount' => -50,
            'reason' => 'Diesel',
            'created_by' => auth()->id(),
            'approval' => Carbon::now(),
            'when' => '12-12-2017 12:00 AM',
        ]);
        $order->updateBalance();
        $this->assertEquals($order->fresh()->pending_balance, 50);
    }
}
