@extends('layouts.app')
@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
        	<h3 class="col">Total Outstanding : {{ moneyFormat($orders->sum('pending_balance'),'INR') }}</h3>
    	</div>

    	<div class="row">
    		<div class="col">
    			<table class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>When</th>
    						<th>Trip</th>
                            <th>Truck</th>
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
									{{ $order->trip->id() }}
								</a>
							</td>
                            <td>{{ $order->trip->truck }}</td>
							<td>
								{{ $order->toHtml() }}
							</td>
							<td>
                                {{ moneyFormat($order->pending_balance, 'INR') }}
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
