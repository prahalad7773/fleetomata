@extends('layouts.app')

@section('head')
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap-daterange-picker/daterangepicker.css">
@append

@section('content')

    <div class="ks-page-content-body ks-tabs-page-container" style="padding-top:0px;">
        <div class="ks-tabs-container-description">
            <h3>{{ $truck->number }}</h3>
            <p>{{ $truck->type }}</p>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="tab" data-target="#trips" aria-expanded="false">
                    Trips
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="trips" role="tabpanel" aria-expanded="false">
                <div class="row">
                    <div class="col" style="display: flex; justify-content: space-between;">
                        <div>
                            <h3>Status : {{ $truck->status() }}</h3>
                        </div>
                        <div>
                            <div class="ks-controls">
                                <button class="btn btn-success" data-toggle="modal" data-target="#createTrip">
                                    <span class="la la-plus ks-icon"></span>
                                    <span class="ks-text">Create Trip</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @include("trucks.revenueStatement.partials._index")
                    </div>
                </div>
            </div>
        </div>
    </div>


    @component('modals.modal')
        @slot('id') createTrip @endslot
        @slot('title') Create A trip for the truck @endslot
        @slot('footer')  @endslot
        <form action="{{ url("trips") }}" method="post">
            {!! csrf_field() !!}
            <input type="text" value="{{ $truck->id }}" name="truck_id" hidden>
            <div class="form-group @if($errors->has('started_at')) has-danger @endif">
                <label for="started_at">Started At</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="la la-calendar"></i>
                    </span>
                    <input type="text" id="started_at" class="form-control" required name="started_at"
                           placeholder="Enter started At" value="">
                </div>
                @if($errors->has('started_at'))
                    @foreach($errors->get('started_at') as $error)
                        <span class="help-block m-b-none">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
            <button class="btn btn-success">
                <span class="la la-plus ks-icon"></span>
                <span class="ks-text">Create Trip</span>
            </button>
        </form>
    @endcomponent
@append

@section('scripts')
    <script src="/libs/momentjs/moment.min.js"></script>
    <script src="/libs/bootstrap-daterange-picker/daterangepicker.js"></script>
    <script>
        $('#started_at').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'DD-MM-YYYY h:mm A'
            }
        });
    </script>

@append
