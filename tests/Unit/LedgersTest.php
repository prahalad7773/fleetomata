<?php

namespace Tests\Unit;

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
        $ledger = factory(Ledger::class)->create();
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
