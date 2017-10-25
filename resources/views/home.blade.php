@extends('layouts.app')

@section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 push-lg-4">
                <ul class="list-group">
                    <a href="{{ url("trucks") }}" class="list-group-item">Trucks</a>
                    <a href="{{ url("trips") }}" class="list-group-item">Trips</a>
                    <a href="{{ url("approvals?status=pending") }}" class="list-group-item">Pending Approvals</a>
                </ul>
            </div>
        </div>
    </div>
</div>
@append
