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
            <table>
                <tr>
                    <td class="col-md-10">
                        <h3>{{ $trip->id() }}</h3>
                        <p>
                            <b> {{ $trip->truck->number }} </b> {{ $trip->status() }} {{ $trip->completed_at ? "at ".$trip->completed_at->toDayDateTimeString() : '' }}
                        </p>
                    </td>
                    <td class="col-md-2">
                        <div class="ks-controls">
                            <a href="#" class="btn btn-primary ks-control" data-toggle="modal" data-target="#createOrder">
                                <span class="ks-icon la la-plus"></span>
                                <span class="ks-text">Order</span>
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="tab" data-target="#orders" aria-expanded="true">
                        Orders
                        <span class="badge badge-danger-outline badge-pill">
                            {{ $orders->count() }}
                        </span>
                    </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" data-target="#ledger" aria-expanded="false">
                        Ledger
                        <span class="badge badge-danger-outline badge-pill"></span>
                    </a>
            </li>
        </ul>
        <div class="tab-content">
            @include('trips.orders.partials._index')
            <div class="tab-pane" id="ledger" role="tabpanel" aria-expanded="false">
                <div class="table-responsive"></div>
            </div>
        </div>
    </div>
</div>

    @include('modals.orders._create')
@append
