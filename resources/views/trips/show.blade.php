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
                        <div class="col">

                        </div>
                        <div class="col-md-4">
                            <div class="panel">
                                <div class="panel-body">
                                    <form action="{{ url("trips/{$trip->id}/orders") }}" class="form" method="post">
                                {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Loading Point</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="loading_point_id" id="loading_point_id" placeholder="Loading Point" autocomplete="off" required>
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                      <label for="default-input" class="col-sm-2 form-control-label">Unloading Point</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="unloading_point_id" id="unloading_point_id" placeholder="Unloading Point" autocomplete="off" required>
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

@append

@section('scripts')
    <script>
    </script>
@append
