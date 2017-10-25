@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-block">
    			<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th width="1">Trip ID</th>
							<th width="150">Truck Number</th>
							<th width="150">Started At</th>
							<th width="200">Order Details</th>
							<th width="200">Status</th>
							<th width="1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($trips as $trip)
						<tr>
							<td>{{ $trip->id() }}</td>
							<td>{{ $trip->truck->number }}</td>
							<td>{{ $trip->started_at->toDayDateTimeString() }}</td>
							<td>
								@foreach($trip->orders as $order)
								<ul>
									<li>{{ $order }}</li>
								</ul>
								@endforeach
							</td>
							<td>{{ $trip->status() }}</td>
							<td>
								<a href="{{ url("trips") }}">
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
