@extends('layouts.app')

@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
        	<h3 class="col-md-10">Credits Statement
        		{{ request()->has('start') ? "From ".request('start') : '' }}
        		{{ request()->has('end') ? " To ".request('end') : '' }}
        	</h3>
			 <div class="col-md-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#filterAdvances">
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
    						<th width="100">When</th>
    						<th width="100">Trip</th>
    						<th width="100">Truck</th>
    						<th width="250">Order</th>
    						<th width="150">Amount</th>
    						<th width="200">Approval</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($ledgers as $ledger)
							<tr>
								<td>{{ $ledger->when->toDayDateTimeString() }}</td>
								<td>
									<a href="{{ url("trips/{$ledger->trip_id}") }}">
										{{ $ledger->trip->id() }}
									</a>
								</td>
								<td>{{ $ledger->trip->truck }}</td>
								<td>{{ $ledger->fromable->toHtml() }} </td>
								<td>{{ moneyFormat($ledger->amount, 'INR') }}</td>
								<td>{{ $ledger->approvalStatus() }}</td>
							</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</div>

@component('modals.modal')
	@slot('id') filterAdvances @endslot
	@slot('title') Filter Advances @endslot
	@slot('footer') @endslot

	<form>
		<div class="form-group row">
		    <label for="default-input" class="col-sm-2 form-control-label">Start</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="start" id="start" placeholder="Start" autocomplete="off">
		    </div>
		</div>
		<div class="form-group row">
		    <label for="default-input" class="col-sm-2 form-control-label">End</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="end" id="end" placeholder="End" autocomplete="off">
		    </div>
		</div>
		 <button class="btn btn-success">
            <span class="la la-filter ks-icon"></span>
            <span class="ks-text">Filter</span>
        </button>
	</form>
@endcomponent
@append

@section('scripts')
	<script type="text/javascript">
		$('#start, #end').daterangepicker({
			'singleDatePicker' : true,
			'timePicker' : false,
			'locale' : {
				format : 'DD-MM-YYYY'
			}
		});
	</script>
@append
