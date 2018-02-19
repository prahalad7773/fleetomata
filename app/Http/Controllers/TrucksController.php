<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\Trucks\TruckExpense;

class TrucksController extends Controller
{
    public function index()
    {
        return view("trucks.index")->with([
            'trucks' => Truck::with('trips')->get(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'number' => 'unique:trucks,number',
            'type' => 'required',
        ]);
        Truck::create([
            'number' => request('number'),
            'type' => request('type'),
            'created_by' => auth()->id(),
        ]);
        return redirect()->back();
    }

    public function show(Truck $truck)
    {
        $truck->load('trips.orders.loadingPoint', 'trips.orders.unloadingPoint', 'expenses.createdBy', 'expenses.approvedBy');
        $activeTrip = collect();
        if ($truck->activeTrip) {
            $activeTrip->push($truck->activeTrip);
        }
        return view("trucks.show")->with([
            'truck' => $truck,
            'activeTrip' => $activeTrip,
            'trips' => $truck->trips,
            'newExpense' => new TruckExpense(),
        ]);
    }
}
