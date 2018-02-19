<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Truck;
use Spatie\Permission\Models\Role;
use App\Models\Trucks\TruckExpense;
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

    /** @test */
    public function truck_expense_can_be_approved_by_admin()
    {
        $user = $this->signIn();
        $role = Role::create(['name'=>'admin']);
        $user->assignRole('admin');

        $expense = factory(TruckExpense::class)->create([
            'approved_by' => null,
        ]);

        $this->assertNull($expense->fresh()->approved_by);

        $this->patch("trucks/{$expense->truck_id}/expenses/{$expense->id}", [
            'type' => 'approval'
        ]);

        $this->assertNotNull($expense->fresh()->approved_by);
        $this->assertEquals($user->id, $expense->fresh()->approved_by);
    }

    /** @test */
    public function expenses_with_other_types_are_not_approved()
    {
        $user = $this->signIn();
        $role = Role::create(['name'=>'admin']);
        $user->assignRole('admin');

        $expense = factory(TruckExpense::class)->create([
            'approved_by' => null,
        ]);

        $this->assertNull($expense->fresh()->approved_by);

        $this->patch("trucks/{$expense->truck_id}/expenses/{$expense->id}", [
            // 'type' => 'approval'
        ]);

        $this->assertNull($expense->fresh()->approved_by);
    }

    /** @test */
    public function expenses_can_be_deleted_by_admin()
    {
        $user = $this->signIn();
        $role = Role::create(['name'=>'admin']);
        $user->assignRole('admin');

        $expense = factory(TruckExpense::class)->create();
        $this->assertNotNull($expense->fresh());
        $this->delete("trucks/{$expense->truck_id}/expenses/{$expense->id}");
        $this->assertNull($expense->fresh());
    }

    /** @test */
    public function non_admins_cannot_delete_or_approve_expense()
    {
        $user = $this->signIn();
        $expense = factory(TruckExpense::class)->create();
        $this->patch("trucks/{$expense->truck_id}/expenses/{$expense->id}")->assertStatus(403);
        $this->delete("trucks/{$expense->truck_id}/expenses/{$expense->id}")->assertStatus(403);
    }
}
