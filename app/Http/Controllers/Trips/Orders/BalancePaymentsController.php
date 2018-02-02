<?php

namespace App\Http\Controllers\Trips\Orders;

use App\Http\Controllers\Controller;
use App\Models\Trips\Order;

class BalancePaymentsController extends Controller
{

    public function index()
    {
        $orders = Order::with('loadingPoint', 'unloadingPoint', 'trip.truck')
            ->where('pending_balance', '>', 0)
            ->orderBy('pending_balance', 'DESC')
            ->get();
        return view("trips.orders.balancePayments.index")->with([
            'orders' => $orders,
        ]);
    }

}
