<table class="table table-bordered dataTable" style="width: auto">
	<thead>
		<tr>
			<th>Trip</th>
			<th>Orders</th>
			<th>Hire</th>
			<th>Received</th>
			<th>Balance</th>
			<th>Diesel</th>
			<th>Fastag</th>
			<th>Enroute</th>
			<th>Cash</th>
			<th>Broker</th>
			<th>Loading</th>
			<th>Unloading</th>
			<th>Expense</th>
			<th>Income</th>
			<th>Km</th>
			<th><i class="la la-inr"></i>/km</th>
			<th>Days</th>
			<th><i class="la la-inr"></i>/Day</th>
		</tr>
	</thead>
	<tbody>
		@foreach($trips as $trip)
		<tr>
			<td>
				<ul>
					<li><a href="{{ url("trips/{$trip->id}")}}">{{ $trip }}</a></li>
					<li><b>Started at : </b>{{ $trip->started_at->toDayDateTimeString() }}</li>
					@forelse($trip->orders as $order)
					<li>{{ $order }}</li>
					@empty
					<li>No Order</li>
					@endforelse
				</ul>
			</td>
			<td>{{ $trip->orders->count() }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->hire }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->income }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->balance }}</td>

			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Diesel"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Fastag"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Enroute"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Cash"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Broker Commission"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Loading Charges"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"Unloading Charges"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"expense"} }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"income"} }}</td>
			<td>{{ $trip->gps_km }}</td>
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->costPerKm }}</td>
			<td>{{ $trip->trip_days }}</td>
			<td>{{ $trip->financeSummary->costPerDay }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
