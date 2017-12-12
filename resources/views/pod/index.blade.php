@extends('layouts.app') @section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            	<table class="table table-bordered table-striped dataTable">
            		<thead>
            			<tr>
            				<th>When</th>
            				<th class="w-25">Order</th>
            				<th>Truck</th>
            				<th>Remarks</th>
            				<th></th>
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
								<button class="btn btn-sm btn-primary updatePODStatus"
									data-toggle="modal"
									data-target="#updatePODStatus"
									data-url="/orders/pod/{{ $order->id }}"
								>
								Update
								</button>
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
@append

@section('scripts')
	<script type="text/javascript">
		$('.updatePODStatus').on('click',function(){
			$('#updatePODStatusForm').attr('action',$(this).data('url'));
		})
	</script>
@append
