@extends('layouts.app') @section('content')
<div class="ks-page-content-body ks-tabs-page-container" style="padding-top:0px;">
    <div class="ks-tabs-container-description" style="display: flex; justify-content: space-between;">
        <div>
            <h3>{{ $truck->number }}</h3>
            <p><b>From </b>{{ $start->toFormattedDateString() }} to {{ $end->toFormattedDateString() }}</p>
        </div>
        <div>
			<div class="ks-controls">
	            <a href="#" class="btn btn-primary ks-control" data-toggle="modal" data-target="#filterRevenueReport">
	                <span class="ks-icon la la-calendar"></span>
	                <span class="ks-text">Filter</span>
	            </a>
        	</div>
    	</div>
   </div>
    <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
        <li class="nav-item">
            <a class="nav-link active" href="#statement" data-toggle="tab" data-target="#statement" aria-expanded="false">
            	Statement
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="statement" role="tabpanel" aria-expanded="false">
        	<div class="ro">
        		<div class="col table-responsive">
        			<table class="table table-bordered dataTable" style="width: auto">
		        		<thead>
		        			<tr>
		        				<th rowspan="2">Trip</th>
		        				<th colspan="3">Hire</th>
		        				<th colspan="7" class="text-center">Expenses</th>
		        				<th colspan="2">Total</th>
		        				<th colspan="2">Cost/KM</th>
		        				<th colspan="2">Trip Days</th>
		        			</tr>
		        			<tr>
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
		        				<th>Income</th>
		        				<th>Km</th>
		        				<th><i class="la la-inr"></i>/km</th>
		        				<th>Days</th>
		        				<th><i class="la la-inr"></i>/Day</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			@foreach($trips as $trip)
							<tr>
								<td>
									<ul>
										<li><a href="{{ url("trips/{$trip->id}")}}">{{ $trip }}</a></li>
										<li><b>Started at : </b>{{ $trip->started_at->toDayDateTimeString() }}</li>
										@forelse($trip->orders as $order)
										<li>{{ $order }}</li>
										@empty
										<li>No Order</li>
										@endforelse
									</ul>
								</td>
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
								<td><i class="la la-inr"></i>{{ $trip->financeSummary->{"income"} }}</td>
								<td>{{ $trip->gps_km }}</td>
								<td><i class="la la-inr"></i>{{ $trip->financeSummary->costPerKm }}</td>
								<td>{{ $trip->trip_days }}</td>
								<td>{{ $trip->financeSummary->costPerDay }}</td>
							</tr>
		        			@endforeach
		        		</tbody>
		        	</table>
        		</div>
        	</div>
        </div>
    </div>
</div>

@component('modals.modal')
	@slot('id') filterRevenueReport @endslot
	@slot('title') Filter Revenue Report @endslot
	@slot('footer')  @endslot
	<form>
		 <div class="form-group row">
		    <label for="default-input" class="col-sm-2 form-control-label">Start</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="start" id="start" placeholder="Start" autocomplete="off" required>
		    </div>
		</div>
		 <div class="form-group row">
		    <label for="default-input" class="col-sm-2 form-control-label">End</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="end" id="end" placeholder="End" autocomplete="off" required>
		    </div>
		</div>
		<button href="#" class="btn btn-primary ks-control">
            <span class="ks-icon la la-calendar"></span>
            <span class="ks-text">Filter</span>
        </button>
	</form>
@endcomponent

@section('scripts')
	<script>
		$('#start, #end').daterangepicker({
			singleDatePicker : true,
			timePicker : false,
			locale : {
				format : 'DD-MM-YYYY'
			}
		});
	</script>
@append

@append
