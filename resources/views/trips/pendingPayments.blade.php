@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col">
    			<table class="table table-bordered table-condensed">
    				<thead>
    					<tr>
    						<th>Trip ID</th>
    						<th>Order</th>
    						<th>When</th>
    						<th>Amount</th>
    						<th></th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($orders as $order)
						<tr>
							<td>{{ $order->trip }}</td>
							<td>{{ $order }}</td>
							<td>{{ $order->when->toDayDateTimeString() }}</td>
							<td>{{ $order }}</td>
						</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</div>

@append
