@extends('layouts.app')

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col table-responsive">
				<ledger-table :approvals="{{ $approvals }}"></ledger-table>
    		</div>
    	</div>
	</div>
</div>

@append
