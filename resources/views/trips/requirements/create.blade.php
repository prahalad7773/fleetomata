@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/css/select2.min.css') }}">
@append

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-4 offset-md-4">
				<form method="post" action="{{ url("requirements") }}">
					{!! csrf_field() !!}
					<div class="form-group row">
				    	<label for="default-input" class="col-sm-2 form-control-label">Truck</label>
				    	<div class="col-sm-10">
					        <select required name="truck_id" id="truck_id" class="form-control" style="width: 100%">
					        	<option value=""></option>
					        	@foreach(App\Models\Truck::all() as $truck)
								<option value="{{ $truck->id }}">{{ $truck }}</option>
					        	@endforeach
					        </select>
				    	</div>
					</div>
					<div class="form-group row">
					    <label for="default-input" class="col-sm-2 form-control-label">Amount</label>
					    <div class="col-sm-10">
					    	<div class="input-group">
					       		<div class="input-group-addon">
					       			<i class="la la-inr"></i>
					       		</div>
					       		<input required type="text" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off">
					       	</div>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="default-input" class="col-sm-2 form-control-label">Type</label>
					    <div class="col-sm-10">
				       		<select required name="type" id="type" class="form-control">
				       			<option value=""></option>
				       			@foreach(\App\Models\Trips\Account::all() as $account)
								<option value="{{ $account->id }}">{{ $account }}</option>
				       			@endforeach
				       		</select>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="default-input" class="col-sm-2 form-control-label">Reason</label>
					    <div class="col-sm-10">
				       		<input required name="reason" id="reason" class="form-control" placeholder="Reason" autocomplete="off">
					    </div>
					</div>
					<button class="btn btn-primary">
	                    <span class="la la-check ks-icon"></span>
	                    <span class="ks-text">Submit</span>
	                </button>
				</form>
    		</div>
    	</div>
    </div>
</div>

@append

@section('scripts')
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script>
	$('#truck_id').select2();
</script>
@append
