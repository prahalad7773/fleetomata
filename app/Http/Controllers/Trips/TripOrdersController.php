<?php

namespace App\Http\Controllers\Trips;

use App\Events\Trips\OrderCreatedEvent;
use App\Helpers\Flash;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Trip;
use App\Models\Trips\Order;
use Illuminate\Http\Request;

class TripOrdersController extends Controller
{
    public function store(Trip $trip, Request $request)
    {
        if (!$trip->isActive()) {
            return redirect()->back();
        }
        $loading = Location::createFromPlaceID($request->loading_place_id);
        $unloading = Location::createFromPlaceID($request->unloading_place_id);
        $order = $trip->orders()
            ->save(
                new Order([
                    'loading_point_id' => $loading->id,
                    'unloading_point_id' => $unloading->id,
                    'when' => $request->when,
                    'cargo' => $request->cargo,
                    'weight' => $request->weight,
                    'hire' => $request->hire,
                    'type' => $request->type,
                    'remarks' => $request->remarks,
                    'pending_balance' => $request->hire,
                ])
            );
        event(new OrderCreatedEvent($order));
        return redirect()->back();
    }

    public function destroy(Trip $trip, Order $order)
    {
        if (auth()->user()->hasRole('admin')) {
            $order->delete();
            Flash::success("Order deleted successfully");
        }
        return redirect()->back();
    }

    public function update(Trip $trip, Order $order, Request $request)
    {
        $loading = Location::createFromPlaceID($request->loading_place_id);
        $unloading = Location::createFromPlaceID($request->unloading_place_id);
        $order->update([
            'loading_point_id' => $loading->id,
            'unloading_point_id' => $unloading->id,
            'cargo' => $request->cargo,
            'weight' => $request->weight,
            'hire' => $request->hire,
            'when' => $request->when,
            'type' => $request->type,
            'remarks' => $request->remarks,
        ]);
        $order->updateBalance();
        Flash::success("Order Updated successfully");
        return redirect()->back();
    }
}
