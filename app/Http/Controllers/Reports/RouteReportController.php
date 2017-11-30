<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Trips\Order;

class RouteReportController extends Controller
{

    public function index()
    {
        $order = Order::with('loadingPoint', 'unloadingPoint')->get();
        $sources = $order->unique('loading_point_id')->pluck('loadingPoint')->unique('locality');
        $destinations = $order->unique('unloading_point_id')->pluck('unloadingPoint')->unique('locality');
        return view("reports.route-report.index", [
            'sources' => $sources,
            'destinations' => $destinations,
        ]);
    }

}
