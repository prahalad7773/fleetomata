@extends('layouts.app') @section('head')
<script src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
@append @section('content')
<div class="ks-page-content-body" style="padding-top:0px;">
    <div class="ks-tabs-page-container">
        <div class="ks-tabs-container-description">
            <table>
                <tr>
                    <td width="800">
                        <h3>{{ $trip->id() }}</h3>
                        <p>
                            <b> {{ $trip->truck->number }} </b> {{ $trip->status() }} {{ $trip->completed_at ? "at ".$trip->completed_at->toDayDateTimeString() : '' }}
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
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Loading Point</th>
                                    <th>Unloading Point</th>
                                    <th>Material</th>
                                    <th>Hire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id() }}</td>
                                    <td>{{ $order->loadingPoint }}</td>
                                    <td>{{ $order->unloadingPoint }}</td>
                                    <td>{{ $order->material() }}</td>
                                    <td>Rs. {{ $order->hire }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-md-center">
                                        <b>No orders yet</b>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <div class="panel">
                            <div class="panel-body">
                                <form action="{{ url("trips/{$trip->id}/orders") }}" class="form" method="post">
                                    {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Loading Point</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span><i class="la la-map-marker"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="loading_formatted" id="loading_formatted" placeholder="Loading Point" autocomplete="off" required>
                                            </div>
                                            <div id="loadingDetails" class="details hidden">
                                                <input type="text" name="loading_place_id" data-geo="place_id" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Unloading Point</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span><i class="la la-map-marker"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="unloading_formatted" id="unloading_formatted" placeholder="Unloading Point" autocomplete="off" required>
                                            </div>
                                            <div id="unloadingDetails" class="details hidden">
                                                <input type="text" name="unloading_place_id" data-geo="place_id" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Cargo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Weight</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" name="weight" id="weight" placeholder="Weight" autocomplete="off" required>
                                                <div class="input-group-addon">
                                                    <span>MT</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Hire Amount</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="la la-inr"></span>
                                                </div>
                                                <input type="number" min="0" class="form-control" name="hire" id="hire" placeholder="Hire Amount" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">
                                        <span class="ks-icon">
                                          <i class="la la-plus"></i>
                                      </span>
                                        <span class="ks-text">Create</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="finances" role="tabpanel" aria-expanded="false">
                <div class="table-responsive"></div>
            </div>
        </div>
    </div>
</div>
@append @section('scripts')
<script src={{ asset( 'js/jquery.geocomplete.min.js') }}></script>
<script>
$('#loading_formatted').geocomplete({
    types: ["geocode", "establishment"],
    details: "#loadingDetails",
    detailsAttribute: "data-geo"
});
$('#unloading_formatted').geocomplete({
    types: ["geocode", "establishment"],

    details: "#unloadingDetails",
    detailsAttribute: "data-geo"
});
</script>
@append
