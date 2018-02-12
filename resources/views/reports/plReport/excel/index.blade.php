<table class="table table-bordered">
	<thead>
		<tr>
			<th>When</th>
			<th>Order</th>
			<th>No of Loads</th>
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
			<th>Profit</th>
			<th>Km</th>
			<th>Cost/km</th>
			<th>Mileage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($trips as $trip)
		<tr>
			<td>
				{{ $trip->started_at->toDayDateTimeString() }}
			</td>
			<td>
			@foreach($trip->orders as $order)
			{{ $order }} <br>
			@endforeach
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
			<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"profit"} }}</td>
			<td>{{ $trip->gps_km }}</td>
			<td>{{ $trip->financeSummary->mileage }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
