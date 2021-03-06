<?php

namespace App\Http\Controllers;

use App\Events\Trips\TripCompletedEvent;
use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\FinanceSummary;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripsController extends Controller
{

    public function index()
    {
        $query = Trip::with('orders.loadingPoint', 'orders.unloadingPoint', 'truck');
        if (!request()->has('status')) {
            $query = $query->whereNull('completed_at');
        }
        return view("trips.index")->with([
            'trips' => $query->get()->sortByDesc('trip_days'),
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
            'orders' => $trip->orders->load('loadingPoint', 'unloadingPoint'),
            'trip' => $trip,
            'ledgers' => $trip->ledgers->load('fromable', 'toable', 'approvedBy')->sortByDesc('when'),
            'accounts' => Account::all(),
            'financeSummary' => (new FinanceSummary($trip))->handle(),
        ]);
    }

    public function update(Trip $trip)
    {
        $trip->update([
            'completed_at' => Carbon::createFromFormat('d-m-Y g:i A', request('completed_at')),
        ]);
        event(new TripCompletedEvent($trip));
        return redirect()->back();
    }

    public function destroy(Trip $trip)
    {
        if (auth()->user()->hasRole('admin')) {
            $trip->delete();
        }
        return redirect("trips");
    }

}
