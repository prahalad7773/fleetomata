<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Trips\Order;
use Illuminate\Http\Request;

class TripOrdersController extends Controller
{
    public function store(Trip $trip, Request $request)
    {
        $trip->orders()
            ->save(
                new Order([
                    'loading_point_id' => $request->loading_point_id,
                    'unloading_point_id' => $request->unloading_point_id,
                    'cargo' => $request->cargo,
                    'weight' => $request->weight,
                    'hire' => $request->hire,
                ])
            );
        return redirect()->back();
    }
}
