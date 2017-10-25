<?php

namespace Tests\Unit;

use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LedgersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ledger_has_approval_status()
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
}
