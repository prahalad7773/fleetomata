@extends('layouts.app') @section('content')
<div class="ks-page-content-body" style="padding-top:0px;">
    <div class="ks-tabs-page-container">
        <div class="ks-tabs-container-description">
            @if ($errors->any())
            <div class="alert alert-danger ks-solid-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <h3>{{ $trip->id() }}</h3>
                    <p>
                        <b> <a href="{{ url("trucks/{$trip->truck_id}") }}">{{ $trip->truck->number }}</a> </b> {{ $trip->status() }} {{ $trip->completed_at ? "at ".$trip->completed_at->toDayDateTimeString() : '' }}
                    </p>
                </div>
                <div>
                    @if(!$trip->completed_at)
                    <div class="ks-controls">
                        <a href="#" class="btn btn-primary ks-control" data-toggle="modal" data-target="#createOrder">
                            <span class="ks-icon la la-plus"></span>
                            <span class="ks-text">Order</span>
                        </a>
                        <a href="#" class="btn btn-danger ks-control" data-toggle="modal" data-target="#completeTrip">
                            <span class="ks-icon la la-check"></span>
                            <span class="ks-text">Completed</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
             <li class="nav-item">
                <a class="nav-link active" href="#tripSummary" data-toggle="tab" data-target="#tripSummary" aria-expanded="true">
                    Trip Summary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#orders" data-toggle="tab" data-target="#orders" aria-expanded="false">
                    Orders
                    <span class="badge badge-danger-outline badge-pill">
                        {{ $orders->count() }}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#ledger" data-toggle="tab" data-target="#ledger" aria-expanded="false">
                    Ledger
                    <span class="badge badge-danger-outline badge-pill">{{ $ledgers->count() }}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            @include('trips.orders.partials._summary')
            @include('trips.orders.partials._index')
            @include('trips.orders.partials._ledger')
        </div>
    </div>
</div>
@include('modals.orders._create')
@include('modals.trips._complete')


@append



@section('scripts')

<script type="text/javascript">

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
       $('a[href="' + activeTab + '"]').tab('show');
    }
$('#ledgerWhen').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'DD-MM-YYYY h:mm A'
    }
});
</script>
@append
