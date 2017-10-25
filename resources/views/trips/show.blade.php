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
                        <b> {{ $trip->truck->number }} </b> {{ $trip->status() }} {{ $trip->completed_at ? "at ".$trip->completed_at->toDayDateTimeString() : '' }}
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
                <a class="nav-link active" href="#" data-toggle="tab" data-target="#tripSummary" aria-expanded="true">
                    Trip Summary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" data-target="#orders" aria-expanded="false">
                    Orders
                    <span class="badge badge-danger-outline badge-pill">
                        {{ $orders->count() }}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" data-target="#ledger" aria-expanded="false">
                    Ledger
                    <span class="badge badge-danger-outline badge-pill">{{ $ledgers->count() }}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tripSummary" role="tabpanel" aria-expanded="true">
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <div class="card panel panel-default">
                        <h5 class="card-header">
                            Finance Summary
                        </h5>
                        <table class="table">
                            <tr>
                                <td><b>Total Hire</b></td>
                                <td><i class="la la-inr"></i>{{ $financeSummary->total }}</td>
                            </tr>
                            <tr>
                                <td><b>Received</b></td>
                                <td><i class="la la-inr"></i>{{ $financeSummary->received }}</td>
                            </tr>
                            <tr>
                                <td><b>Balance</b></td>
                                <td><i class="la la-inr"></i>{{ $financeSummary->balance()  }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Expense</b></td>
                                <td><i class="la la-inr"></i>{{ $financeSummary->expense  }}</td>
                            </tr>
                            <tr>
                                <td><b>Gross Margin</b></td>
                                <td><i class="la la-inr"></i>{{ $financeSummary->margin()  }}</td>
                            </tr>
                            <tr>
                                <td><b>Margin %</b></td>
                                <td>{{ $financeSummary->marginPercentage()  }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
