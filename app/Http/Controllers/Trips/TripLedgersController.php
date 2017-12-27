<?php

namespace App\Http\Controllers\Trips;

use App\Helpers\Flash;
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
        $request->from = json_decode($request->from, true);
        $request->to = json_decode($request->to, true);
        $ledger->fromable_id = $request->from['id'];
        $ledger->fromable_type = $request->from['type'];
        $ledger->toable_id = $request->to['id'];
        $ledger->toable_type = $request->to['type'];
        $ledger->amount = $ledger->getAmount($request->amount);
        $ledger->reason = $request->reason;
        $ledger->when = $request->when;
        $ledger->created_by = auth()->id();
        $trip->ledgers()->save($ledger);
        // $ledger->updateOrderBalance();
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
                $ledger->updateOrderBalance();
            }
        } else if ($request->type != 'other') {
            $ledger->update([
                'when' => $request->when,
                'amount' => $request->amount,
                'reason' => $request->reason,
            ]);
            Flash::success("Ledger Updated successfully");
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function destroy(Trip $trip, Ledger $ledger)
    {
        if (auth()->user()->hasRole('admin') || !$ledger->isApproved()) {
            $ledger->delete();
        }
        return redirect()->back();
    }

}
