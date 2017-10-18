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
                        <span class="badge badge-danger-outline badge-pill">{{ $ledgers->count() }}</span>
                    </a>
            </li>
        </ul>
        <div class="tab-content">
            @include('trips.orders.partials._index')
            <div class="tab-pane" id="ledger" role="tabpanel" aria-expanded="false">
                <div class="row tables-page">
                    <div class="col">
                        <table class="table table-striped table-bordered" style="min-width: 600px">
                            <thead>
                                <tr>
                                    <th>When</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Approval</th>
                                </tr>
                                <form action="{{ url("trips/{$trip->id}/ledgers") }}" method="post">
                                    {!! csrf_field() !!}
                                    <tr>
                                        <td>
                                             <div class="form-group">
                                                <div class="">
                                                    <input type="text" class="form-control" name="when" id="ledgerWhen" placeholder="When" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="from" id="from" class="form-control">
                                                    @foreach(App\Models\Trips\Account::all() as $account)
                                                    <option value="{{ $account }}">{{ $account }}</option>
                                                    @endforeach @foreach($orders as $order)
                                                    <option value="{{ $order->customer }}">{{ $order->customer }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="to" id="to" class="form-control">
                                                    @foreach(App\Models\Trips\Account::all() as $account)
                                                    <option value="{{ $account }}">{{ $account }}</option>
                                                    @endforeach @foreach($orders as $order)
                                                    <option value="{{ $order->customer }}">{{ $order->customer }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="la la-inr"></i>
                                                    </div>
                                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="reason" id="reason" placeholder="Reason" autocomplete="off" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary">
                                                <span class="ks-icon">
                                            <i class="la la-plus"></i>
                                        </span>
                                                <span class="ks-text">
                                            Add
                                        </span>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            </thead>
                            <tbody>
                                @foreach($ledgers as $ledger)
                                <tr>
                                    <td>{{ $ledger->when->toDayDateTimeString() }}</td>
                                    <td>{{ $ledger->fromable }}</td>
                                    <td>{{ $ledger->toable }}</td>
                                    <td>
                                        <i class="la la-inr"></i>
                                        {{ $ledger->amount }}
                                    </td>
                                    <td>{{ $ledger->reason }}</td>
                                    <td>{{ $ledger->approvalStatus() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.orders._create') @append

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
