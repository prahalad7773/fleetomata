<div class="tab-pane " id="revenue" role="tabpanel" aria-expanded="true">
    <table class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>Trip ID</th>
                <th>Order Details</th>
                <th width="100">Diesel Expense</th>
                <th width="100">Toll Expense</th>
                <th width="100">Enroute Expense</th>
                <th width="100">Net Expense</th>
                <th width="100">Hire</th>
                <th width="100">Received</th>
                <th width="100">Margin</th>
                <th width="100">Margin %</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
            <tr>
                <td>
                    <a href="{{ url("trips/{$trip->id}") }}">{{ $trip->id() }}</a>
                </td>
                <td>
                    <ul>
                        <li>{{ $trip->started_at->toDayDateTimeString() }}</li>
                        @foreach($trip->orders as $order)
                        <li>{{ $order }}</li>
                        @endforeach
                    </ul>
                </td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->dieselExpense }}</td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->tollExpense }}</td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->enrouteExpense }}</td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->expense }}</td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->total }}</td>
                <td><i class="la la-inr"></i>{{ $trip->financeSummary->received }}</td>
                <td class="{{ $trip->financeSummary->margin() < 0 ? " bg-danger " : " " }}">
                    <i class="la la-inr"></i>{{ $trip->financeSummary->margin() }}
                </td>
                <td>{{ $trip->financeSummary->marginPercentage() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
