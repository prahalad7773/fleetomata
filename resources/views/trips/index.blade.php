@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-block table-responsive">
				@include("trips.partials._index",[
					'showTruck' => true,
					'truck' => false,
					'showCompleted' => false
				])
    		</div>
    	</div>
    </div>
</div>

@append
