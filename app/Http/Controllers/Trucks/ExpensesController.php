<?php

namespace App\Http\Controllers\Trucks;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\Trucks\TruckExpense;
use App\Http\Controllers\Controller;

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
}
