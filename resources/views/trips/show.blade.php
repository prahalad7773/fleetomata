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
                        <td width=""></td>
                    </tr>
                </table>
            </div>
            <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-toggle="tab" data-target="#orders" aria-expanded="true">
                        Orders
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
                <div class="tab-pane ks-column-section active" id="orders" role="tabpanel" aria-expanded="true">
                    <div class="row">

                    </div>
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
