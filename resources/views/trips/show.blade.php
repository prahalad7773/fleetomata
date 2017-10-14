@extends('layouts.app')

@section('content')
    <div class="ks-page-content-body" style="padding-top:0px;">
        <div class="ks-tabs-page-container">
            <div class="ks-tabs-container-description">
                <table>
                    <tr>
                        <td width="800">
                            <h3>{{ $trip->id() }}</h3>
                            <p>
                                <b> {{ $trip->truck->number }} </b>
                                {{ $trip->status() }} {{ $trip->completed_at ? "at ".$trip->completed_at->toDayDateTimeString() : '' }}
                            </p>
                        </td>
                        <td width="">
                            <div class="card">
                                <div class="card-block">
                                    <div class="ks-item-block">
                                        <button class="btn btn-success add-finance-class "
                                                data-toggle="modal"
                                                data-target="#addFinance"
                                                data-id="{{ $trip->id }}"
                                                data-class="{{ get_class($trip) }}"
                                                data-type="trip"
                                        >
                                            <span class="la la-plus ks-icon"></span>
                                            <span class="ks-text">Expense</span>
                                        </button>
                                        @if(!$trip->completed_at)
                                            <button class="btn btn-danger"
                                                    data-toggle="modal"
                                                    data-target="#updateTripStatus"
                                            >
                                                <span class="la la-check ks-icon"></span>
                                                <span class="ks-text">Completed</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-toggle="tab" data-target="#wayPoints" aria-expanded="true">
                        Way Points
                        <span class="badge badge-danger-outline badge-pill"></span>
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
                <div class="tab-pane ks-column-section active" id="wayPoints" role="tabpanel" aria-expanded="true">
                    <div class="row"></div>
                </div>
                <div class="tab-pane" id="finances" role="tabpanel" aria-expanded="false">
                    <div class="table-responsive"></div>
                </div>
            </div>
        </div>
    </div>

@append

@section('scripts')
    <script>
    </script>
@append
