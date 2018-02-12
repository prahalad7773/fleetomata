@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="ks-widget ks-widget-overview">
		            <div class="ks-body">
		                <h5 class="ks-header">Requirements</h5>
		                <table class="table table-bordered">
		                	<tr>
		                		<td><b>Diesel :</b> <i class="la la-inr"></i> {{ $approvalSummary->diesel }}</td>
		                		<td><b>Fastag :</b> <i class="la la-inr"></i> {{ $approvalSummary->fastag }}</td>
		                		<td><b>Cash :</b> <i class="la la-inr"></i> {{ $approvalSummary->cash }}</td>
		                		<td><b>Happay :</b> <i class="la la-inr"></i> {{ $approvalSummary->happay }}</td>
		                	</tr>
		                </table>
		            </div>
    			</div>
			</div>
		</div>
    	<div class="row">
    		<div class="col table-responsive">
				<ledger-table :approvals="{{ $approvals }}"></ledger-table>
    		</div>
    	</div>

	</div>
</div>

@append
