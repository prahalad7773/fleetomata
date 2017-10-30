@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-block table-responsive">
    			<table class="table table-bordered table-striped dataTable" style="min-width: 800px">
					<thead>
						<tr>
							<th width="1">Trip ID</th>
							<th width="100">Truck Number</th>
							<th width="300">Order Details</th>
							<th width="100">Status</th>
							<th width="100">Trip Days</th>
							<th width="1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($trips as $trip)
						<tr>
							<td>{{ $trip->id() }}</td>
							<td>{{ $trip->truck->number }}</td>
							<td>
								<ul>
									<li><b>Started at : </b>{{ $trip->started_at->toDayDateTimeString() }}</li>
								@foreach($trip->orders as $order)
									<li>{{ $order }}</li>
								@endforeach
								</ul>
							</td>
							<td>{{ $trip->status() }}</td>
							<td>{{ $trip->tripDays() }}</td>
							<td>
								<a href="{{ url("trips/{$trip->id}") }}">
									<i class="la la-eye"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
    		</div>
    	</div>
    </div>
</div>

@append
