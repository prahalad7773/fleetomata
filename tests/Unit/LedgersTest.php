<?php

namespace Tests\Unit;

use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Trips\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LedgersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ledgerHasApprovalStatus()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $user = factory(User::class)->create();
        $time = Carbon::now();
        $this->assertTrue($ledger->approvalStatus() == 'Not Approved');
        $ledger->update([
            'approval' => $time,
            'approved_by' => $user->id,
        ]);
        $string = sprintf("Approved at %s by %s", $time->toDayDateTimeString(), $user->name);
        $this->assertTrue($ledger->approvalStatus() == $string);
    }

    /** @test */
    public function ledgerHasIsApproved()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
            'approval' => \Carbon\Carbon::now(),
            'approved_by' => factory(User::class)->create()->id,
        ]);
        $this->assertTrue($ledger->isApproved());
        $ledger->update([
            'approval' => null,
        ]);
        $this->assertFalse($ledger->isApproved());
    }

    /** @test */
    public function ledgerCanUpdateOrdersPendingApproval()
    {
        $pending_balance = 100;
        $from = factory(Order::class)->create([
            'pending_balance' => $pending_balance,
        ]);
        $to = Account::create(['name' => 'JSM HQ']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
            'amount' => 50,
            'approval' => \Carbon\Carbon::now(),
            'approved_by' => factory(User::class)->create()->id,
        ]);
        $this->assertTrue($from->pending_balance == $pending_balance);
        $ledger->updateOrderBalance();
        $this->assertEquals($from->fresh()->pending_balance, 50);
    }

    /** @test */
    public function ledgerHasId()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'BPCL']);
        $ledger = factory(Ledger::class)->create([
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $this->assertEquals($ledger->id(), "L#{$ledger->id}");
    }
}
