@extends('layouts.app')

@section('head')
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap-daterange-picker/daterangepicker.css">
@append

@section('content')

    <div class="ks-page-content-body ks-tabs-page-container" style="padding-top:0px;">
        <div class="ks-tabs-container-description">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <h3>{{ $truck->number }}</h3>
                    <p>{{ $truck->type }}</p>
                </div>
                <div>
                    <div class="ks-controls">
                        <button class="btn btn-success" data-toggle="modal" data-target="#createTrip">
                            <span class="la la-plus ks-icon"></span>
                            <span class="ks-text">Create Trip</span>
                        </button>

                        <div class="btn-group">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="la la-files-o ks-icon"></span>
                                <span class="ks-text">Actions</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ url("trucks/{$truck->id}/revenue-report") }}">
                                    Revenue Report
                                </a>
                                <a class="dropdown-item"
                                    href="{{ url("trucks/{$truck->id}/ledgers") }}">
                                    Ledgers
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(request()->has('type'))
                    <div class="alert" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="window.location = window.location.pathname">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                        <strong>Filtering by</strong> {{ request('type') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
            <li class="nav-item">
                <a class="nav-link active" href="#trips" data-toggle="tab" data-target="#trips" aria-expanded="false">
                    Trips
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#expenses" data-toggle="tab" data-target="#expenses" aria-expanded="false">
                    Expenses
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="trips" role="tabpanel" aria-expanded="false">
                <div class="row">
                    <div class="col">
                    @include("trips.partials._index",[
                            'showTruck' => false,
                            'trips' => $activeTrip,
                            'showCompleted' => false
                        ])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @include("trips.partials._index",[
                            'showTruck' => false,
                            'trips' => $trips,
                            'showCompleted' => true,
                            'datatable' => true
                        ])
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="expenses" role="tabpanel" aria-expanded="false">
                @include('trucks.expenses.partials._index',[
                    'expenses' => $truck->expenses,
                    'showCreate' => true,
                    'showTruck' => false,
                ])
            </div>

        </div>
    </div>

    @include('trucks.modals._createTrip')

@append
