<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TruckExpenseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_truck_expense()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $truck = factory(Truck::class)->create();
        $this->assertEquals($truck->fresh()->expenses()->count(), 0);
        $expense = [
            'when' => '12-07-1993',
            'type' => 'Driver Salary',
            'amount' => 100,
            'reason' => 'Driver salary for the month of August',
        ];

        $this->post("trucks/{$truck->id}/expenses", $expense);

        $this->assertEquals($truck->fresh()->expenses()->count(), 1);
    }
}
