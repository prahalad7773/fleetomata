<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TruckExpenseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function truck_has_an_expense()
    {
        $truck = factory(Truck::class)->create();
        $this->assertEquals($truck->fresh()->expenses()->count(), 0);
        $expense = $truck->expenses()->create([
            'when' => '12-07-1993',
            'reason' => 'Truck Maintainance',
            'amount' => -1000,
            'created_by' => 1,
            'approved_by' => 1,
        ]);
        $this->assertEquals($truck->fresh()->expenses()->count(), 1);
    }
}
