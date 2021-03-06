<?php

namespace Tests\Unit;

use App\Models\Trips\Account;
use App\Models\Trips\ApprovalSummary;
use App\Models\Trips\Ledger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApprovalSummaryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function approval_summary_has_total_diesel_expenses()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'Diesel']);
        $ledger = factory(Ledger::class, 10)->create([
            'amount' => 100,
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $approvalSummary = new ApprovalSummary($ledger);
        $this->assertEquals($approvalSummary->diesel, (100 * 10));
    }

    /** @test */
    public function approval_summary_has_total_happay_expenses()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'Happay']);
        $ledger = factory(Ledger::class, 10)->create([
            'amount' => 100,
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $approvalSummary = new ApprovalSummary($ledger);
        $this->assertEquals($approvalSummary->happay, (100 * 10));
    }

    /** @test */
    public function approval_summary_has_total_Toll_expenses()
    {
        $from = Account::create(['name' => 'JSM HQ']);
        $to = Account::create(['name' => 'Fastag']);
        $ledger = factory(Ledger::class, 10)->create([
            'amount' => 100,
            'fromable_id' => $from->id,
            'toable_id' => $to->id,
            'fromable_type' => get_class($from),
            'toable_type' => get_class($to),
        ]);
        $approvalSummary = new ApprovalSummary($ledger);
        $this->assertEquals($approvalSummary->fastag, (100 * 10));
    }
}
