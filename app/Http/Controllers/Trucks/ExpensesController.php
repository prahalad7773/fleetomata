<?php

namespace App\Http\Controllers\Trucks;

use Carbon\Carbon;
use App\Models\Truck;
use App\Helpers\Flash;
use Illuminate\Http\Request;
use App\Models\Trucks\TruckExpense;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trucks\ExpenseDeleteRequest;
use App\Http\Requests\Trucks\ExpenseApprovalRequest;

class ExpensesController extends Controller
{
    public function store(Truck $truck)
    {
        $truck->expenses()->save(
            new TruckExpense([
                'when' => request('when'),
                'amount' => -1.00 * request('amount'),
                'type' => request('type'),
                'reason' => request('reason'),
                'reason' => request('reason'),
                'created_by' => auth()->id(),
            ])
        );
        return redirect()->back();
    }

    public function update(Truck $truck, TruckExpense $expense, ExpenseApprovalRequest $request)
    {
        if (request()->get('type') == 'approval') {
            $expense->update([
                'approved_by' => auth()->id(),
                'approved_at' => Carbon::now(),
            ]);
            Flash::success("Expense Approved");
        } else {
            Flash::error("Expense cannot be approved");
        }
        return redirect()->back();
    }

    public function destroy(Truck $truck, TruckExpense $expense, ExpenseDeleteRequest $request)
    {
        $expense->delete();
        Flash::success("Expense Deleted");
        return redirect()->back();
    }
}
