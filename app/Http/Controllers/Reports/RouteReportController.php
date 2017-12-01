<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Trips\FinanceSummary;
use App\Models\Trips\Order;

class RouteReportController extends Controller
{

    public function index()
    {
        $order = Order::with('loadingPoint', 'unloadingPoint')->get();
        $trips = collect();
        if (request()->has('source') && request()->has('destination')) {
            $trips = $this->getTrips();
        }
        return view("reports.route-report.index", [
            'sources' => $order->unique('loading_point_id')->pluck('loadingPoint')->unique('locality'),
            'destinations' => $order->unique('unloading_point_id')->pluck('unloadingPoint')->unique('locality'),
            'trips' => $trips,
        ]);
    }

    protected function getTrips()
    {
        $loading = collect();
        $unloading = collect();
        Location::all()->each(function ($location) use ($loading, $unloading) {
            if ($location->locality == request('source')) {
                $loading->push($location->id);
            }
            if ($location->locality == request('destination')) {
                $unloading->push($location->id);
            }
        });
        $trips = Order::with('loadingPoint', 'unloadingPoint', 'trip.truck', 'trip.ledgers.fromable', 'trip.ledgers.toable')
            ->whereIn('loading_point_id', $loading->toArray())
            ->whereIn('unloading_point_id', $unloading->toArray())
            ->get()
            ->unique('trip.id')
            ->pluck('trip')
            ->reject(function ($trip) {
                return $trip->completed_at == null;
            });

        return $trips->each(function ($trip) {
            $trip->financeSummary = (new FinanceSummary($trip))->handle();
        });

    }

}
