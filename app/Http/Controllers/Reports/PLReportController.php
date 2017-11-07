<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Truck;
use Maatwebsite\Excel\Facades\Excel;

class PLReportController extends Controller
{

    public function index()
    {
        Excel::create('p l statement', function ($excel) {
            Truck::all()->each(function ($truck) use ($excel) {
                $excel->sheet($truck->number, function ($sheet) use ($truck) {
                    $sheet->setAutoSize(true);
                    $trips = $truck->trips()
                        ->with('orders.loadingPoint', 'orders.unloadingPoint', 'ledgers.fromable', 'ledgers.toable')
                        ->get()
                        ->each(function ($trip) {
                            $trip->financeSummary = $trip->financeSummary();
                        });
                    $sheet->loadView('reports.plReport.excel.index')->with([
                        'trips' => $trips,
                    ]);
                });
            });
        })->export('xlsx');
    }

}
