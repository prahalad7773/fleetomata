@extends('layouts.app')

@section('head')

@append

@section('content')

<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col table-responsive">
    			@include("trucks.expenses.partials._index",[
					'showCreate' => false,
					'showTruck' => true,
					'expenses' => $expenses
    			])
    		</div>
    	</div>
    </div>
</div>

@append