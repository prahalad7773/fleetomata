<?php

namespace App\Helpers;

class TopSheetItem
{
    public $truck;
    public $totalProfit;
    public $totalExpense;
    public $totalTurnOver;
    public $totalKMs;
    public $averageMileage;
    private $trips;

    public function __construct($trips, $truck)
    {
        $this->trips = $trips;
        $this->truck = $truck;
        $this->totalProfit = $trips->sum('financeSummary.profit');
        $this->totalExpense = $trips->sum('financeSummary.expense');
        $this->totalTurnOver = $trips->sum('financeSummary.hire');
        $this->totalKMs = $trips->sum('gps_km');
        $this->averageMileage = $trips->average('mileage');
    }

}
