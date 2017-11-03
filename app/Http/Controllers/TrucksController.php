<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrucksController extends Controller
{

    public function index()
    {
        return view("trucks.index")->with([
            'trucks' => Truck::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'number' => 'unique:trucks,number',
            'type' => 'required',
        ]);
        Truck::create([
            'number' => request('number'),
            'type' => request('type'),
            'created_by' => auth()->id(),
        ]);
        return redirect()->back();
    }

    public function show(Truck $truck)
    {
        switch (request('type')) {
            case 'trips':
                list($trips, $ledgers) = $this->caseTrips($truck);
                break;
            case 'ledgers':
                list($trips, $ledgers) = $this->caseLedgers($truck);
                break;
            default:
                $trips = $truck->trips->load('orders.loadingPoint', 'orders.unloadingPoint')->sortByDesc('completed_at');
                $ledgers = $truck->trips->load('ledgers.fromable', 'ledgers.toable')->pluck('ledgers')->collapse()->sortByDesc('when');
        }
        $activeTrip = $trips->pop();
        if ($activeTrip) {
            $trips->prepend($activeTrip);
        }
        return view("trucks.show")->with([
            'truck' => $truck,
            'trips' => $trips,
            'ledgers' => $ledgers,
        ]);
    }

    protected function caseTrips($truck)
    {
        $trips = $truck->trips()
            ->with('orders.loadingPoint', 'orders.unloadingPoint')
            ->whereBetween('started_at', [
                Carbon::createFromFormat('d-m-Y', request('start'))->toDateString(),
                Carbon::createFromFormat('d-m-Y', request('end'))->toDateString(),
            ])
            ->get();
        $ledgers = $truck->trips
            ->load('ledgers.fromable', 'ledgers.toable')
            ->pluck('ledgers')
            ->collapse();
        return [$trips, $ledgers];
    }

    protected function caseLedgers($truck)
    {
        $trips = $truck->trips->load('orders.loadingPoint', 'orders.unloadingPoint');
        $ledgers = $truck->trips()
            ->with('ledgers.fromable', 'ledgers.toable')
            ->whereHas('ledgers', function ($query) {
                $query->whereBetween('when', [
                    Carbon::createFromFormat('d-m-Y', request('start'))->toDateString(),
                    Carbon::createFromFormat('d-m-Y', request('end'))->toDateString(),
                ]);
            })->get()->pluck('ledgers')->collapse()->sortByDesc('when');
        return [$trips, $ledgers];
    }
}
