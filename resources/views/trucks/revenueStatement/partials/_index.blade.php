<table class="table table-bordered table-striped dataTable" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center" rowspan="2">Trip ID</th>
            <th class="text-center" rowspan="2">Order Details</th>
            <th class="text-center" colspan="4">Expense</th>
            <th class="text-center" colspan="2">Income</th>
            <th class="text-center">Margin</th>
        </tr>
        <tr>
            <th>Diesel</th>
            <th>Toll</th>
            <th>Enroute</th>
            <th>Net</th>
            <th>Hire</th>
            <th>Received</th>
            <th>Margin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trips as $trip)
        <tr>
            <td>
                <a href="{{ url(" trips/{$trip->id}") }}">{{ $trip->id() }}</a>
                @if(!$trip->completed_at)
                <span class="badge badge-success ks-sm">Active Trip</span>
                @endif
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
            <td>
                <p><i class="la la-inr"></i>{{ $trip->financeSummary->margin() }}</p>
                <p>
                     <span class="badge ks-circle {{ $trip->financeSummary->margin() < 0 ? "badge-danger" : "badge-success" }}"></span>
                    {{ $trip->financeSummary->marginPercentage() }}
                </p>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
