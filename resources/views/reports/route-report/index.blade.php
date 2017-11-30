@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/css/select2.min.css') }}">
@append

@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            	<form>
	                <div class="form-group">
	                    <label for="source">Source</label>
	                    <select style="width:100%;" class="form-control" name="source" id="source">
	                        @foreach($sources as $source)
	                        <option value="{{ $source->id }}">{{ $source->locality }}</option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="form-group">
	                    <label for="destination">Destination</label>
	                    <select style="width:100%;" class="form-control" name="destination" id="destination">
	                        @foreach($destinations as $destination)
	                        <option value="{{ $destination->id }}">{{ $destination->locality }}</option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="form-group">
						<label for="type">Type</label>
			            <select name="type" id="type" class="form-control">
			                <option value=""></option>
			                <option value="24ft SXL Container">24ft SXL Container</option>
			                <option value="32ft MXL Container">32ft MXL Container</option>
			            </select>
	                </div>
	                <div class="form-group">
	                    <button class="btn btn-primary">
	                        <span class="la la-filter ks-icon"></span>
	                        <span class="ks-text">Filter</span>
	                    </button>
	                </div>
            	</form>
            </div>
            <div class="col">

            </div>
		</div>
    </div>
</div>
@append

@section('scripts')
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script>
$('#source, #destination').select2();
</script>
@append
