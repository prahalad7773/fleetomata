<?php

namespace App\Http\Controllers\Trucks;

use App\Models\Truck;
use App\Models\Trips\Ledger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgersController extends Controller
{
    public function index(Truck $truck)
    {
        $trips = $truck->trips->pluck('id');
        $ledgers = Ledger::with('fromable', 'toable', 'trip.truck', 'trip.orders.loadingPoint', 'trip.orders.unloadingPoint')->whereIn('trip_id', $trips)->orderBy('when', 'desc')->get();
        return view("trucks.ledgers.index")->with([
            'ledgers' => $ledgers,
            'truck' => $truck,
        ]);
    }
}
