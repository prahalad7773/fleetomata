<?php

namespace App\Http\Controllers\Reports;

use App\Helpers\TopSheetItem;
use App\Http\Controllers\Controller;
use App\Models\Truck;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PLReportController extends Controller
{

    public function index()
    {
        return view("reports.plReport.index", [
            'trucks' => Truck::all(),
        ]);
    }

    public function store()
    {
        $topSheet = collect();
        Excel::create("PL Statement", function ($excel) use ($topSheet) {
            Truck::whereIn('id', request('trucks'))->each(function ($truck) use ($excel, $topSheet) {
                $trips = $this->getTrips($truck);
                $topSheet->push(new TopSheetItem($trips, $truck));
                $excel->sheet($truck->number, function ($sheet) use ($trips) {
                    $sheet->loadView('reports.plReport.excel.index')->with([
                        'trips' => $trips,
                    ]);
                });
            });
            $excel->sheet('TopSheet', function ($sheet) use ($topSheet) {
                $sheet->loadView('reports.plReport.excel.topSheet')->with([
                    'topSheetItems' => $topSheet,
                ]);
            });
        })->export('xlsx');
    }

    protected function getTrips(Truck $truck)
    {
        return $truck->trips()
            ->with('orders.loadingPoint', 'orders.unloadingPoint', 'ledgers.fromable', 'ledgers.toable')
            ->whereBetween('started_at', [
                Carbon::createFromFormat('d-m-Y', request('start'))->startOfDay(),
                Carbon::createFromFormat('d-m-Y', request('end'))->endOfDay(),
            ])
            ->get()
            ->each(function ($trip) {
                $trip->financeSummary = $trip->financeSummary();
            });
    }

}
