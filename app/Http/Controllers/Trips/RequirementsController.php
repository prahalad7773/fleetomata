<?php

namespace App\Http\Controllers\Trips;

use App\Helpers\Flash;
use App\Http\Controllers\Controller;
use App\Models\Trips\Account;
use App\Models\Trips\ApprovalSummary;
use App\Models\Trips\Ledger;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{

    public function index()
    {
        $approvals = Ledger::query()->where('amount', '<', 0);
        if (request('status') == 'pending') {
            $approvals->whereNull('approval');
        }
        $approvals = $approvals->get()
            ->load('fromable', 'toable', 'trip.orders.loadingPoint', 'trip.orders.unloadingPoint', 'trip.truck');
        $approvalSummary = new ApprovalSummary($approvals);
        return view("trips.requirements.index")->with([
            'approvals' => $approvals,
            'approvalSummary' => $approvalSummary,
        ]);
    }

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

    public function remittance()
    {
        $remittance = collect();
        $date = Carbon::today();
        if (request()->has('date')) {
            $date = Carbon::createFromFormat('d-m-Y', request('date'));
        }
        $remittance = Ledger::with('fromable', 'toable',
            'trip.orders.loadingPoint', 'trip.orders.unloadingPoint', 'trip.truck')
            ->where('fromable_type', '!=', 'App\Models\Trips\Order')
            ->whereNotNull('approval')
            ->whereBetween(
                'when',
                [
                    (new Carbon($date))->startOfDay(),
                    (new Carbon($date))->endOfDay(),
                ]
            )->get();
        return view("trips.requirements.remittance")->with([
            'remittance' => $remittance,
        ]);
    }

}
