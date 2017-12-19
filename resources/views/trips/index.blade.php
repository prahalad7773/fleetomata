@extends('layouts.app') @section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col offset-md-8">
                <a class="btn btn-primary" href="{{ url("trips") }}">Live</a>
                <a class="btn btn-primary" href="{{ url("trips?status=completed") }}">All</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card-block table-responsive">
                    @include("trips.partials._index",[ 'showTruck' => true, 'truck' => false, 'showCompleted' => false, 'datatable' => true, ])
                </div>
            </div>
        </div>
    </div>
</div>
@append
