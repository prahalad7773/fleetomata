@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/css/select2.min.css') }}">
@append

@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            	<form class="" style="display: flex; justify-content: center;">
	                <div class="form-group" style="margin-left: 1em">
	                    <label for="source">Source</label>
	                    <select required style="width:100%;" class="form-control" name="source" id="source">
	                    	<option value="">Select a value</option>
	                        @foreach($sources as $source)
	                        <option value="{{ $source->locality }}"
								@if(request('source') == $source->locality ) selected @endif
	                        	>{{ $source->locality }}</option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="form-group" style="margin-left: 1em">
	                    <label for="destination">Destination</label>
	                    <select required style="width:100%;" class="form-control" name="destination" id="destination">
	                    	<option value="">Select a value</option>
	                        @foreach($destinations as $destination)
	                        <option value="{{ $destination->locality }}"
								@if(request('destination') == $destination->locality ) selected @endif
	                        	>{{ $destination->locality }}</option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="form-group" style="margin-left: 1em">
	                	<br>
	                    <button class="btn btn-primary">
	                        <span class="la la-filter ks-icon"></span>
	                        <span class="ks-text">Filter</span>
	                    </button>
	                </div>
            	</form>
            </div>
		</div>
		<div class="row">
			 <div class="col">
				<table class="table table-borderd dataTable">
					<thead>
						<tr>
							<th>Date</th>
							<th>Trip</th>
							<th>Diesel</th>
							<th>Enroute</th>
							<th>Fastag</th>
							<th>Cash</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($trips as $trip)
						<tr>
							<td>{{ $trip->started_at->format('d-m-Y') }}</td>
							<td>
								<a href="{{ url("trips/{$trip->id}") }}">{{ $trip }}</a> -
								<a href="{{ url("trucks/{$trip->truck_id}") }}">{{ $trip->truck }}</a>
								<ul>
									{{-- @foreach($trip->orders as $order)
									<li>{{ $order }}</li>
									@endforeach --}}
								</ul>
							</td>
							<td><i class="la la-inr"></i>{{ $trip->financeSummary->{'Diesel'} }}</td>
							<td><i class="la la-inr"></i>{{ $trip->financeSummary->{'Enroute'} }}</td>
							<td><i class="la la-inr"></i>{{ $trip->financeSummary->{'Fastag'} }}</td>
							<td><i class="la la-inr"></i>{{ $trip->financeSummary->{'Cash'} }}</td>
							<td><i class="la la-inr"></i>{{ $trip->financeSummary->{'expense'} }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td><i class="la la-inr"></i>{{ round($trips->average('financeSummary.Diesel'),2) }}</td>
							<td><i class="la la-inr"></i>{{ round($trips->average('financeSummary.Enroute'),2) }}</td>
							<td><i class="la la-inr"></i>{{ round($trips->average('financeSummary.Fastag'),2) }}</td>
							<td><i class="la la-inr"></i>{{ round($trips->average('financeSummary.Cash'),2) }}</td>
							<td><i class="la la-inr"></i>{{ round($trips->average('financeSummary.expense'),2) }}</td>
						</tr>
					</tfoot>
				</table>
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
