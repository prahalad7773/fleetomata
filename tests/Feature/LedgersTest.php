<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LedgersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ledger_has_account_as_from_and_to()
    {
        $this->signIn();
        $from = $this->createAccount('JSM HQ');
        $this->withoutExceptionHandling();
        $to = $this->createAccount('BPCL');
        $trip = factory(Trip::class)->create();
        $this->post("trips/{$trip->id}/ledgers", [
            'from' => $from->name,
            'to' => $to->name,
            'amount' => 100,
            'when' => '12-12-2017 12:00 AM',
            'reason' => 'Diesel advance',
        ]);
        $this->assertTrue($trip->ledgers()->first()->fromable->name == $from->name);
        $this->assertTrue($trip->ledgers()->first()->toable->name == $to->name);
    }

    /** @test */
    public function fund_transferred_from_jsm_to_other_accounts_are_negative()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $from = $this->createAccount('JSM HQ');
        $to = $this->createAccount('BPCL');
        $amount = 100;
        $trip = factory(Trip::class)->create();
        $this->post("trips/{$trip->id}/ledgers", [
            'when' => '12-12-2017 12:00 AM',
            'from' => $from->name,
            'to' => $to->name,
            'amount' => $amount,
            'reason' => 'Diesel advance',
        ]);
        $this->assertEquals($trip->ledgers()->first()->amount, -1 * $amount);

    }

    /** @test */
    public function ledgers_can_be_approved_by_admin()
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
            'type' => 'approval',
        ]);
        $this->assertEquals($ledger->fresh()->approved_by, $user->id);

    }

    /** @test */
    public function non_admins_cannot_approve_ledger()
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
    public function ledgers_with_other_types_are_not_approved()
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

    public function createAccount($name)
    {
        return Account::create([
            'name' => $name,
        ]);
    }
}
