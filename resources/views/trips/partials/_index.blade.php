<table class="table table-bordered table-striped dataTable" style="min-width: 800px">
	<thead>
		<tr>
			<th width="1">Trip ID</th>
			@if($showTruck)
			<th width="100">Truck Number</th>
			@endif
			<th width="100">When</th>
			<th width="300">Order Details</th>
			<th width="100">Status</th>
			@if($showCompleted)
			<th width="100">Completed at</th>
			@endif
			<th width="100">Trip Days</th>
		</tr>
	</thead>
	<tbody>
		@foreach($trips as $trip)
		<tr>
			<td>
				<a href="{{ url("trips/{$trip->id}") }}">
					{{ $trip->id() }}
				</a>
				<br>
				@if($truck && !$trip->completed_at)
                <span class="badge badge-success ks-sm">Active Trip</span>
                @endif
			</td>
			@if($showTruck)
			<td>{{ $trip->truck->number }}</td>
			@endif
			<td>{{ $trip->started_at->toDayDateTimeString() }}</td>
			<td>
				<ul>
				@forelse($trip->orders as $order)
					<li>{{ $order }}</li>
				@empty
					<li>Waiting for load</li>
				@endforelse
				</ul>
			</td>
			<td>{{ $trip->status() }}</td>
			@if($showCompleted)
			<td>
				{{ optional($trip->completed_at)->toDayDateTimeString() }}
			</td>
			@endif
			<td>{{ $trip->tripDays() }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
