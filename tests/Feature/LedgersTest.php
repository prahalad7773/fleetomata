<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Trips\Account;
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
        $this->assertTrue($trip->ledgers()->first()->from->name == $from->name);
        $this->assertTrue($trip->ledgers()->first()->to->name == $to->name);
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

    public function createAccount($name)
    {
        return Account::create([
            'name' => $name,
        ]);
    }
}
