@extends('layouts.app') @section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
		<div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
	    	<h3 class="col-md-10">POD Status filtered by {{ request()->has('received') ? 'Received' : 'Pending' }}</h3>
			<div class="col-md-2">
				<button class="btn btn-primary" data-toggle="modal" data-target="#filterPODs">
	                <span class="la la-filter ks-icon"></span>
	                <span class="ks-text">Filter</span>
	            </button>
			</div>
		</div>
        <div class="row">
            <div class="col">
            	<table class="table table-bordered table-striped dataTable">
            		<thead>
            			<tr>
            				<th>When</th>
            				<th width="250">Order</th>
            				<th>Truck</th>
            				<th>Remarks</th>
            				<th width="150">
            					@if(request('status') == 'received')
									POD Status
            					@endif
            				</th>
            			</tr>
            		</thead>
            		<tbody>
            			@foreach($orders as $order)
						<tr>
							<td>{{ $order->when->toFormattedDateString() }}</td>
							<td>
								<a href="{{ url("trips/{$order->trip_id}") }}">{{ $order->trip->id() }}</a><br>
								{{ $order }}<br>
								{{ $order->customer() }}
							</td>
							<td>{{ $order->trip->truck }}</td>
							<td>{{ $order->remarks ?? "No Remarks" }}</td>
							<td>
								@if(request('status') == 'received')
								{{ $order->pod_status }}
								@else
								<button class="btn btn-sm btn-primary updatePODStatus"
									data-toggle="modal"
									data-target="#updatePODStatus"
									data-url="/trips/orders/pods/{{ $order->id }}"
								>
								Update
								</button>
								@endif
							</td>
						</tr>
            			@endforeach
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>

@component('modals.modal')
	@slot('id') updatePODStatus @endslot
	@slot('title') Update POD status @endslot
	@slot('footer') @endslot
	<form action="{{ url("orders/pod") }}" method="post" id="updatePODStatusForm">
		{!! csrf_field() !!}
		{!! method_field('PATCH') !!}
		<div class="form-group row">
		    <label for="default-input" required class="col-sm-2 form-control-label">POD Status</label>
		    <div class="col-sm-10">
		    	<textarea name="pod_status" cols="30" rows="10" class="form-control"></textarea>
		    </div>
		</div>
		<button class="btn btn-primary">
			Update
		</button>
	</form>
@endcomponent

@component('modals.modal')
	@slot('id') filterPODs @endslot
	@slot('title') Filter POD @endslot
	@slot('footer') @endslot
	<form>
		<div class="form-group row">
		    <label for="default-input" required class="col-sm-2 form-control-label">POD Status</label>
		    <div class="col-sm-10">
		    	<select name="status" id="status" class="form-control">
		    		<option value="pending">Pending</option>
		    		<option value="received">Received</option>
		    	</select>
		    </div>
		</div>
		<button class="btn btn-primary">
            <span class="la la-filter ks-icon"></span>
            <span class="ks-text">Filter</span>
        </button>
	</form>
@endcomponent


@append

@section('scripts')
	<script type="text/javascript">
		$('.updatePODStatus').on('click',function(){
			$('#updatePODStatusForm').attr('action',$(this).data('url'));
		})
	</script>
@append
