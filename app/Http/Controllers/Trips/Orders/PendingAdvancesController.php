<?php

namespace App\Http\Controllers\Trips\Orders;

use App\Http\Controllers\Controller;
use App\Models\Trips\Orders\AdvanceLedger;

class PendingAdvancesController extends Controller
{

    public function index()
    {
        $ledgers = AdvanceLedger::with('fromable', 'toable', 'trip.orders.loadingPoint', 'trip.orders.unloadingPoint', 'trip.truck')->pending()
            ->get();
        return view("trips.orders.advances.index")->with([
            'ledgers' => $ledgers,
        ]);
    }

}
