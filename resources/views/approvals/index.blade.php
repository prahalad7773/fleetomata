@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3 push-lg-4">
    			<div class="ks-widget ks-widget-overview">
	                <div class="ks-body">
	                    <h5 class="ks-header">Requirements</h5>
	                    <ul class="ks-items">
	                        <li class="ks-item">
	                            <span class="la la-inr ks-icon"></span>
	                            <span class="ks-text">
	                            	<b>BPCL</b>
	                            	{{ $approvalSummary->dieselRequirement }}
	                            </span>
	                        </li>
	                        <li class="ks-item">
	                            <span class="la la-inr ks-icon"></span>
	                            <span class="ks-text">
	                            	<b>Fastag</b>
	                            	{{ $approvalSummary->fastagRequirement }}
	                            </span>
	                        </li>
	                        <li class="ks-item">
	                            <span class="la la-inr ks-icon"></span>
	                            <span class="ks-text">
	                            	<b>Happay</b>
	                            	{{ $approvalSummary->happayRequirement }}
	                            </span>
	                        </li>
	                    </ul>
	                </div>
            	</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col table-responsive">
				@include('trips.ledgers.partials._index',[
					'showForm' => false,
					'showOrder' => true,
					'ledgers' => $approvals
				])
    		</div>
    	</div>

	</div>
</div>

@append
