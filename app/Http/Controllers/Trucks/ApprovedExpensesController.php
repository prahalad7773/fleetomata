<?php

namespace App\Http\Controllers\Trucks;

use Illuminate\Http\Request;
use App\Models\Trucks\TruckExpense;
use App\Http\Controllers\Controller;

class ApprovedExpensesController extends Controller
{
    public function index()
    {
        return view("trucks.approved-expenses.index")->with([
            'expenses' => TruckExpense::whereNotNull('approved_by')->orderBy('when', 'desc')->get()
        ]);
    }
}
