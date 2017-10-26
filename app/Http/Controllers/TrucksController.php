<?php

namespace App\Http\Controllers;

use App\Models\Trips\FinanceSummary;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrucksController extends Controller
{

    public function index()
    {
        return view("trucks.index")->with([
            'trucks' => Truck::all(),
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
        $start = request()->has('start') ? Carbon::createFromFormat('d-m-Y', request('start')) : Carbon::now()->startOfMonth();
        $end = request()->has('end') ? Carbon::createFromFormat('d-m-Y', request('start')) : Carbon::now();
        $trips = $truck->trips()
            ->with('ledgers.fromable', 'ledgers.toable', 'orders.loadingPoint', 'orders.unloadingPoint')
            ->where([
                ['started_at', '>', $start],
                ['started_at', '<', $end],
            ])->get();
        $trips->each(function ($trip) {
            $trip->financeSummary = (new FinanceSummary($trip))->handle();
        });
        return view("trucks.show")->with([
            'truck' => $truck,
            'trips' => $trips,
        ]);
    }

}
