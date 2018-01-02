<?php

namespace App\Http\Controllers\Trips\Orders;

use App\Http\Controllers\Controller;
use App\Models\Trips\Ledger;
use Carbon\Carbon;

class CreditsController extends Controller
{

    public function index()
    {
        $query = Ledger::with('fromable', 'toable', 'trip', 'trip.orders', 'trip.truck')
            ->where('fromable_type', 'App\Models\Trips\Order');
        if (request()->has('start') && request()->has('end')) {
            $query = $query->whereBetween('when', [
                Carbon::createFromFormat('d-m-Y', request()->get('start'))->startOfDay(),
                Carbon::createFromFormat('d-m-Y', request()->get('end'))->endOfDay(),
            ]);
        }

        return view("trips.orders.credits.index")->with([
            'ledgers' => $query->get(),
        ]);
    }

}
