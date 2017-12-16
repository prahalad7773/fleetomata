<?php

namespace App\Http\Controllers\Trips\Orders;

use App\Helpers\Flash;
use App\Http\Controllers\Controller;
use App\Models\Trips\Order;
use Illuminate\Http\Request;

class PODsController extends Controller
{
    public function index()
    {
        $query = Order::with('trip.truck', 'loadingPoint', 'unloadingPoint')
            ->whereIn('type', [0, 1]);
        if (request('status') == 'pending') {
            $query = $query->whereNull('pod_status');
        }
        return view("trips.orders.pod.index")->with([
            'orders' => $query->get(),
        ]);
    }

    public function update(Order $pod)
    {
        $pod->update([
            'pod_status' => request('pod_status'),
        ]);
        Flash::success("POD Status Updated");
        return redirect()->back();
    }

}
