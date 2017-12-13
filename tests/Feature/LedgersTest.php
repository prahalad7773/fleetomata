<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LedgersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ledgerHasAccountAsFromAndTo()
    {
        $this->signIn();
        $from = $this->createAccount('JSM HQ');
        $this->withoutExceptionHandling();
        $to = $this->createAccount('BPCL');
        $trip = factory(Trip::class)->create();
        $this->post("trips/{$trip->id}/ledgers", [
            'from' => json_encode([
                'id' => $from->id,
                'type' => get_class($from),
            ]),
            'to' => json_encode([
                'id' => $to->id,
                'type' => get_class($to),
            ]),
            'amount' => 100,
            'when' => '12-12-2017 12:00 AM',
            'reason' => 'Diesel advance',
        ]);
        $this->assertTrue($trip->ledgers()->first()->fromable->name == $from->name);
        $this->assertTrue($trip->ledgers()->first()->toable->name == $to->name);
    }

    /** @test */
    public function fundTransferredFromJsmToOtherAccountsAreNegative()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $from = $this->createAccount('JSM HQ');
        $to = $this->createAccount('BPCL');
        $amount = 100;
        $trip = factory(Trip::class)->create();
        $this->post("trips/{$trip->id}/ledgers", [
            'when' => '12-12-2017 12:00 AM',
            'from' => json_encode([
                'id' => $from->id,
                'type' => get_class($from),
            ]),
            'to' => json_encode([
                'id' => $to->id,
                'type' => get_class($to),
            ]),
            'amount' => $amount,
            'reason' => 'Diesel advance',
        ]);
        $this->assertEquals($trip->ledgers()->first()->amount, -1 * $amount);

    }

    /** @test */
    public function ledgersCanBeApprovedByAdmin()
    {
        $user = factory(User::class)->create();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
        $this->signIn($user);
        $this->withoutExceptionHandling();
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $this->assertNull($ledger->approval);
        $this->assertNull($ledger->approved_by);
        $this->patch("trips/{$ledger->trip_id}/ledgers/{$ledger->id}", [
            'type' => 'approval',
        ]);
        $this->assertEquals($ledger->fresh()->approved_by, $user->id);

    }

    /** @test */
    public function nonAdminsCannotApproveLedger()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $this->assertNull($ledger->approval);
        $this->assertNull($ledger->approved_by);
        $this->patch("trips/{$ledger->trip_id}/ledgers/{$ledger->id}", [
            'type' => 'approval',
        ]);
        $this->assertNull($ledger->fresh()->approval);
    }

    /** @test */
    public function ledgersWithOtherTypesAreNotApproved()
    {
        $user = factory(User::class)->create([
            'email' => 'itsme@theyounus.com',
        ]);
        $this->signIn($user);
        $this->withoutExceptionHandling();
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $this->assertNull($ledger->approval);
        $this->assertNull($ledger->approved_by);
        $this->patch("trips/{$ledger->trip_id}/ledgers/{$ledger->id}", [
            'type' => 'other',
        ]);
        $this->assertNull($ledger->fresh()->approved_by);
        $this->assertNull($ledger->fresh()->approval);
    }

    /** @test */
    public function adminCanDeleteApprovedLedgers()
    {
        $user = factory(User::class)->create([
            'email' => 'itsme@theyounus.com',
        ]);
        $this->signIn($user);
        $this->withoutExceptionHandling();
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $this->delete("trips/{$ledger->trip_id}/ledgers/{$ledger->id}");
        $this->assertNull($ledger->fresh());
    }

    /** @test */
    public function nonAdminsCannotDeleteLedgers()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
            'approval' => Carbon::now(),
            'approved_by' => auth()->id(),
        ]);
        $this->delete("trips/{$ledger->trip_id}/ledgers/{$ledger->id}");
        $this->assertNotNull($ledger->fresh());

    }

    /** @test */
    public function whenLedgersAreApprovedPendingBalanceIsUpdated()
    {
        $user = $this->signIn();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
        $this->withoutExceptionHandling();
        $ledgerAmount = 80;
        $hire = 100;
        $order = factory(Order::class)->create([
            'hire' => $hire,
            'pending_balance' => $hire,
        ]);
        $to = $this->createAccount('JSM HQ');
        $ledger = Ledger::create([
            'when' => '12-12-2017 12:00 AM',
            'trip_id' => $order->trip_id,
            'fromable_id' => $order->id,
            'fromable_type' => get_class($order),
            'toable_id' => $to->id,
            'toable_type' => get_class($to),
            'amount' => $ledgerAmount,
            'reason' => 'Advance',
            'created_by' => auth()->id(),
        ]);
        $this->assertEquals($order->pending_balance, $hire);
        $this->patch("trips/{$ledger->trip_id}/ledgers/{$ledger->id}", [
            'type' => 'approval',
        ]);
        $this->assertEquals($order->fresh()->pending_balance, $hire - $ledgerAmount);
    }

    // /** @test */
    // public function moneyTransferredToJsmHqUpdatesOrderPendingBalance()
    // {
    //     $this->signIn();
    //     $to = Account::create(['name' => 'JSM HQ']);
    //     $pending_balance = 200;
    //     $order = factory(Order::class)->create([
    //         'pending_balance' => $pending_balance,
    //     ]);
    //     $this->withoutExceptionHandling();
    //     $amount = 100;
    //     $this->post("trips/{$order->trip_id}/ledgers", [
    //         'when' => '12-12-2017 12:00 AM',
    //         'from' => json_encode([
    //             'id' => $order->id,
    //             'type' => get_class($order),
    //         ]),
    //         'to' => json_encode([
    //             'id' => $to->id,
    //             'type' => get_class($to),
    //         ]),
    //         'amount' => $amount,
    //         'reason' => 'Diesel advance',
    //     ]);
    //     $this->assertEquals($order->fresh()->pending_balance, ($pending_balance - $amount));
    // }

    public function createAccount($name)
    {
        return Account::create([
            'name' => $name,
        ]);
    }
}
