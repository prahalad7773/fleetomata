<?php

namespace App\Http\Controllers\Trucks;

use App\Http\Controllers\Controller;
use App\Models\Trips\FinanceSummary;
use App\Models\Truck;
use Carbon\Carbon;

class RevenueStatementController extends Controller
{

    public function index(Truck $truck)
    {
        $start = request()->has('start') ? Carbon::createFromFormat('d-m-Y', request('start')) : Carbon::now()->startOfMonth();
        $end = request()->has('end') ? Carbon::createFromFormat('d-m-Y', request('start')) : Carbon::now();
        $trips = $truck->trips()->where([
            ['started_at', '>', $start],
            ['started_at', '<', $end],
        ])->get();
        $trips->each(function ($trip) {
            $trip->financeSummary = (new FinanceSummary($trip))->handle();
        });
        return view("revenueStatement.index")->with([
            'trips' => $trips,
        ]);
    }

}
