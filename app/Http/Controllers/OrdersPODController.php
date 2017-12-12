<?php

namespace App\Http\Controllers;

use App\Helpers\Flash;
use App\Models\Trips\Order;

class OrdersPODController extends Controller
{

    public function index()
    {
        $orders = Order::with('trip.truck', 'loadingPoint', 'unloadingPoint')
            ->whereIn('type', [0, 1])
            ->whereNull('pod_status')
            ->get();
        return view("pod.index")->with([
            'orders' => $orders,
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
