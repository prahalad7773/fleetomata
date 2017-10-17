<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Trip;
use App\Models\Trips\Customer;
use App\Models\Trips\Order;
use Illuminate\Http\Request;

class TripOrdersController extends Controller
{
    public function store(Trip $trip, Request $request)
    {
        request()->validate([
            'customer_phone' => 'unique:customers,phone',
        ]);
        if (!$trip->isActive()) {
            return redirect()->back();
        }
        $loading = Location::createFromPlaceID($request->loading_place_id);
        $unloading = Location::createFromPlaceID($request->unloading_place_id);
        $customer = Customer::firstOrCreate([
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
        ]);
        $trip->orders()
            ->save(
                new Order([
                    'loading_point_id' => $loading->id,
                    'unloading_point_id' => $unloading->id,
                    'when' => $request->when,
                    'cargo' => $request->cargo,
                    'weight' => $request->weight,
                    'hire' => $request->hire,
                    'customer_id' => $customer->id,
                ])
            );
        return redirect()->back();
    }
}
