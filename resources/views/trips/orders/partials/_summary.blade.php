<div class="tab-pane active" id="tripSummary" role="tabpanel" aria-expanded="true">
    <div class="row">
        <div class="col-md-4">
            <div class="card panel panel-default">
                <h5 class="card-header">Finance Summary</h5>
                <table class="table">
                    <tr>
                        <td>Hire</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->hire }}</td>
                    </tr>
                    <tr>
                        <td>Income</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->income }}</td>
                    </tr>
                    <tr>
                        <td>Balance</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->balance }}</td>
                    </tr>
                    {{-- <tr>
                        <td>Expense</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"expense"} }}</td>
                    </tr>
                    <tr>
                        <td>Profit</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"profit"} }}</td>
                    </tr> --}}
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card panel panel-default">
                <h5 class="card-header">
                    Operation Summary
                </h5>
                <table class="table">
                    <tr>
                        <td>GPS KM</td>
                        <td>{{ $trip->gps_km }} km</td>
                    </tr>
                    <tr>
                        <td>Mileage</td>
                        <td>{{ $financeSummary->mileage }} kmpl</td>
                    </tr>
                    <tr>
                        <td>Cost / Km</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->costPerKm }}</td>
                    </tr>
                    <tr>
                        <td>Trip Days</td>
                        <td>{{ $trip->trip_days }}</td>
                    </tr>
                    {{-- <tr>
                        <td>Cost / Day</td>
                        <td>{{ $financeSummary->costPerDay }}</td>
                    </tr>
                    <tr>
                        <td>Profit / Day</td>
                        <td>{{ $financeSummary->profitPerDay }}</td>
                    </tr> --}}
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card panel panel-default">
                <h5 class="card-header">
                    Expense Summary
                </h5>
                <table class="table">

                    <tr>
                        <td>Diesel</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"Diesel"} }}</td>
                    </tr>
                    <tr>
                        <td>Fastag</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"Fastag"} }}</td>
                    </tr>
                    <tr>
                        <td>Enroute</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"Enroute"} }}</td>
                    </tr>
                    <tr>
                        <td>Cash</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"Cash"} }}</td>
                    </tr>
                    <tr>
                        <td>Broker</td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->{"Broker Commission"} }}</td>
                    </tr>
                    <tr>
                        <td>L/C &amp; U/L</td>
                        <td>
                            <i class="la la-inr"></i>{{ $financeSummary->{"Loading Charges"} }} /
                            <i class="la la-inr"></i>{{ $financeSummary->{"Unloading Charges"} }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
