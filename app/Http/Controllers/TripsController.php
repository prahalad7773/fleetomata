<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripsController extends Controller
{

    public function index()
    {
        return view("trips.index")->with([
            'trips' => Trip::whereNull('completed_at')->orderBy('started_at', 'desc')->get(),
        ]);
    }

    public function store()
    {
        $truck = Truck::findOrFail(request('truck_id'));
        $trip = $truck->createTrip(request('started_at'));
        if ($trip) {
            return redirect("trips/{$trip->id}");
        }
        return redirect()->back();
    }

    public function show(Truck $truck, Trip $trip)
    {
        return view("trips.show")->with([
            'truck' => $truck,
            'orders' => $trip->orders->load('loadingPoint', 'unloadingPoint', 'customer'),
            'trip' => $trip,
            'ledgers' => $trip->ledgers->load('fromable', 'toable', 'approvedBy'),
            'accounts' => Account::all(),
            'financeSummary' => $trip->financeSummary(),
        ]);
    }

    public function update(Trip $trip)
    {
        $trip->update([
            'completed_at' => Carbon::createFromFormat('d-m-Y g:i A', request('completed_at')),
        ]);
        return redirect()->back();
    }

}
