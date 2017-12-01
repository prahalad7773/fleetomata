@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/css/select2.min.css') }}">
@append

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-4 offset-md-4">
    			<div class="panel panel-default">
    				<div class="panel-heading">
						Generate P/L Report
    				</div>
    				<div class="panel-body">
    					<form method="post" action="{{ url("reports/p-l-report") }}">
    						{!! csrf_field() !!}
    						<div class="form-group row">
    						    <label for="default-input" class="col-sm-2 form-control-label">Trucks</label>
    						    <div class="col-sm-10">
    						        <select name="trucks[]" id="trucks" class="form-control" style="width: 100%" multiple>
    						        	@foreach($trucks as $truck)
										<option value="{{ $truck->id }}">{{ $truck }}</option>
    						        	@endforeach
    						        </select>
    						    </div>
    						</div>
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
							<button class="btn btn-primary">
			                    <span class="la la-check ks-icon"></span>
			                    <span class="ks-text">Submit</span>
                			</button>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

@append

@section('scripts')
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script>
	$('#trucks').select2();
	$('#start, #end').daterangepicker({
		singleDatePicker : true,
		timePicker : false,
		locale : {
			format : 'DD-MM-YYYY'
		}
	});
</script>
@append
