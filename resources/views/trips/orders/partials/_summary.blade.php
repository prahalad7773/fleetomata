<div class="tab-pane active" id="tripSummary" role="tabpanel" aria-expanded="true">
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <div class="card panel panel-default">
                <h5 class="card-header">
                Finance Summary
            </h5>
                <table class="table">
                    <tr>
                        <td><b>Total Hire</b></td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->total }}</td>
                    </tr>
                    <tr>
                        <td><b>Received</b></td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->received }}</td>
                    </tr>
                    <tr>
                        <td><b>Balance</b></td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->balance() }}</td>
                    </tr>
                    <tr>
                        <td><b>Total Expense</b></td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->expense }}</td>
                    </tr>
                    <tr>
                        <td><b>Gross Margin</b></td>
                        <td><i class="la la-inr"></i>{{ $financeSummary->margin() }}</td>
                    </tr>
                    <tr>
                        <td><b>Margin %</b></td>
                        <td>{{ $financeSummary->marginPercentage() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
