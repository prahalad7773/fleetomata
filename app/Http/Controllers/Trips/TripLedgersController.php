<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Trips\Account;
use App\Models\Trips\Customer;
use App\Models\Trips\Ledger;
use Illuminate\Http\Request;

class TripLedgersController extends Controller
{

    public function store(Trip $trip, Request $request)
    {
        $from = $this->getClassType($request->from);
        $to = $this->getClassType($request->to);
        $ledger = new Ledger();
        $ledger->fillFrom($from)->fillTo($to);
        $ledger->amount = $from->name == 'JSM HQ' ? $request->amount * -1 : $request->amount;
        $ledger->reason = $request->reason;
        $ledger->when = $request->when;
        $ledger->created_by = auth()->id();
        $trip->ledgers()->save($ledger);
        return redirect()->back();
    }

    protected function getClassType($value)
    {
        return Account::where('name', $value)->first() ?: Customer::where('name', $value)->first();
    }

}
