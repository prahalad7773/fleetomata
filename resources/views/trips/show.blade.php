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
                <a class="nav-link" href="#" data-toggle="tab" data-target="#finances" aria-expanded="false">
                        Finances
                        <span class="badge badge-danger-outline badge-pill"></span>
                    </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane ks-column-section active" id="orders" role="tabpanel" aria-expanded="true">
                @foreach($orders->chunk(2) as $row)
                <div class="row">
                    @foreach($row as $order)
                        <div class="col-md-6">
                            <div class="card panel panel-default ks-widget ks-widget-progress-list">
                                <div class="card-header">
                                    {{ $order->customer }}
                                    <div class="ks-controls">
                                        <a href="#" class="ks-control ks-update"><span class="ks-icon la la-refresh"></span></a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="ks-item">
                                        <div class="ks-info">
                                            <div class="ks-wrapper">
                                                <div class="ks-text">
                                                    <p><b>From : </b>{{ $order->loadingPoint }}</p>
                                                    <p><b>To : </b>{{ $order->unloadingPoint }}</p>
                                                    <p><b>Material : </b>{{ $order->material() }}</p>
                                                    <p><b>When : </b>{{ $order->when() }}</p>
                                                    <p><b>Contact : </b>+91 {{ $order->customer->phone }}</p>
                                                </div>
                                                 <span class="text-muted">Created at : {{ $order->created_at->toDayDateTimeString() }}</span>
                                            </div>
                                            <span class="ks-percent"><i class="la la-inr"></i>{{ $order->hire }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div class="tab-pane" id="finances" role="tabpanel" aria-expanded="false">
                <div class="table-responsive"></div>
            </div>
        </div>
    </div>
</div>
@component('modals.modal') @slot('id') createOrder @endslot @slot('title') Create a new Order @endslot @slot('footer') @endslot @include('trips.orders.partials._create') @endcomponent @append
