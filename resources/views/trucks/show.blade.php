@extends('layouts.app')

@section('head')
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap-daterange-picker/daterangepicker.css">
@append

@section('content')

    <div class="ks-page-content-body ks-tabs-page-container" style="padding-top:0px;">
        <div class="ks-tabs-container-description">
            <h3>{{ $truck->number }}</h3>
            <p>{{ $truck->type }}</p>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="tab" data-target="#trips" aria-expanded="false">
                    Trips
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="trips" role="tabpanel" aria-expanded="false">
                <div class="row">
                    <div class="col" style="display: flex; justify-content: space-between;">
                        <div>
                            <h3>Status : {{ $truck->status() }}</h3>
                        </div>
                        <div>
                            <div class="ks-controls">
                                <button class="btn btn-success" data-toggle="modal" data-target="#createTrip">
                                    <span class="la la-plus ks-icon"></span>
                                    <span class="ks-text">Create Trip</span>
                                </button>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#filterTrips">
                                    <span class="la la-calendar ks-icon"></span>
                                    <span class="ks-text">Filter Trip</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @include("trucks.revenueStatement.partials._index")
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('trucks.modals._createTrip')
    @include('trucks.modals._filtertrips')

@append
