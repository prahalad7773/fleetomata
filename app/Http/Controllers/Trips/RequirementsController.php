<?php

namespace App\Http\Controllers\Trips;

use App\Helpers\Flash;
use App\Http\Controllers\Controller;
use App\Models\Trips\Account;
use App\Models\Trips\Ledger;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{

    public function create()
    {
        return view("trips.requirements.create");
    }

    public function store(Request $request)
    {
        $truck = Truck::findOrFail($request->truck_id);
        $trip = $truck->activeTrip ?? $truck->createTrip(Carbon::now()->format('d-m-Y g:i A'));
        $this->createLedger($request, $trip);
        Flash::success("Requirement Created");
        return redirect()->back();
    }

    protected function createLedger(Request $request, $trip)
    {
        $ledger = new Ledger();
        $ledger->fillFrom(Account::first());
        $ledger->fillTo(Account::findOrFail($request->type));
        $ledger->amount = $request->amount * -1;
        $ledger->reason = $request->reason;
        $ledger->when = Carbon::now()->format('d-m-Y g:i A');
        $ledger->created_by = auth()->id();
        $trip->ledgers()->save($ledger);
    }

}
