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
					@include('trucks.reports.revenueReport.partials._index')
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
