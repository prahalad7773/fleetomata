<?php

namespace App\Http\Controllers\Trucks;

use Illuminate\Http\Request;
use App\Models\Trucks\TruckExpense;
use App\Http\Controllers\Controller;

class PendingExpensesController extends Controller
{
    public function index()
    {
        return view("trucks.pending-expenses.index")->with([
            'approvals' => TruckExpense::pending()->get()
        ]);
    }
}
