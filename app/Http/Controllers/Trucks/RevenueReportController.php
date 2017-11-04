<?php

namespace App\Http\Controllers\Trucks;

use App\Http\Controllers\Controller;
use App\Models\Trips\Account;
use App\Models\Truck;
use Carbon\Carbon;

class RevenueReportController extends Controller
{

    public function index(Truck $truck)
    {
        $start = request()->has('start') ? Carbon::createFromFormat('d-m-Y', request('start')) : Carbon::now()->startOfMonth();
        $end = request()->has('end') ? Carbon::createFromFormat('d-m-Y', request('end')) : Carbon::now()->endOfMonth();
        $trips = $truck->trips()
            ->with('orders', 'ledgers.fromable', 'ledgers.toable')
            ->whereBetween('started_at', [$start, $end])
            ->get()
            ->each(function ($trip) {
                $trip->financeSummary = $trip->financeSummary();
            });
        // dispatch(new CalculateGPSKm($trips->first()));
        return view("trucks.reports.revenueReport.index")->with([
            'start' => $start,
            'end' => $end,
            'truck' => $truck,
            'trips' => $trips,
            'accounts' => Account::all(),
        ]);
    }

}
