<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Trips\Ledger;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripLedgersController extends Controller
{

    public function store(Trip $trip, Request $request)
    {
        $ledger = new Ledger();
        $ledger->fromable_id = $request->fromable_id;
        $ledger->fromable_type = $request->fromable_type;
        $ledger->toable_id = $request->toable_id;
        $ledger->toable_type = $request->toable_type;
        $ledger->amount = $this->getAmount($request->fromable_id, $request->fromable_type, $request->amount);
        $ledger->reason = $request->reason;
        $ledger->when = $request->when;
        $ledger->created_by = auth()->id();
        $trip->ledgers()->save($ledger);
        $ledger->updateOrderBalance();
        return redirect()->back();
    }

    public function update(Trip $trip, Ledger $ledger, Request $request)
    {
        if ($request->type == 'approval') {
            if (auth()->user()->hasRole('admin')) {
                $ledger->update([
                    'approval' => Carbon::now(),
                    'approved_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->back();
    }

    public function destroy(Trip $trip, Ledger $ledger)
    {
        if (auth()->user()->isAdmin() || !$ledger->isApproved()) {
            $ledger->delete();
        }
        return redirect()->back();
    }

    public function getAmount($id, $type, $amount)
    {
        return $type::find($id)->name == 'JSM HQ' ? -1 * $amount : $amount;
    }

}
