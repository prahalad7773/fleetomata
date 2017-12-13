@extends('layouts.app')
@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
        	<h3 class="col">Total Outstanding : <i class="la la-inr"></i> {{ $orders->sum('pending_balance') }}</h3>
    	</div>

    	<div class="row">
    		<div class="col">
    			<table class="table table-bordered table-striped dataTable">
    				<thead>
    					<tr>
    						<th>When</th>
    						<th>Trip</th>
    						<th>Order</th>
    						<th>Pending</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($orders as $order)
						<tr>
							<td>{{ $order->when->toFormattedDateString() }}</td>
							<td>
								<a href="{{ url("trips/{$order->trip_id}/") }}">
									T#{{ $order->trip_id }}
								</a>
							</td>
							<td>
								{{ $order->toHtml() }}
							</td>
							<td><i class="la la-inr"></i> {{ $order->pending_balance }}</td>
						</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</div>
@append
