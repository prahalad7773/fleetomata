@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3 offset-md-3">
    			<form>
    				<div class="form-group row">
    				    <label for="default-input" class="col-sm-2 form-control-label">Date</label>
    				    <div class="col-sm-10">
    				        <div class="input-group">
    				        	<input type="text" class="form-control" name="date" id="date" placeholder="Date" autocomplete="off">
    				        	<div class="input-group-btn">
    				        		<button class="btn btn-primary">
    				        			<span class="ks-icon la la-filter"></span>
    				        			<span class="ks-text">Filter</span>
    				        		</button>
    				        	</div>
    				        </div>
    				    </div>
    				</div>
    			</form>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col table-responsive">
				@include('trips.ledgers.partials._index',[
					'showForm' => false,
					'showOrder' => true,
					'ledgers' => $remittance
				])
    		</div>
    	</div>

	</div>
</div>

@append

@section('scripts')
	<script>
		$('#date').daterangepicker({
			singleDatePicker : true,
			timePicker : false,
			locale : {
				format : 'DD-MM-YYYY'
			}
		});
	</script>
@append
