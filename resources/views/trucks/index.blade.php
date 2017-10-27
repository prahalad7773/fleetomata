@extends('layouts.app')

@section('content')

    <div class="ks-page-content-body" style="padding-top: 0px;">
        <div class="container-fluid">
            <div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
                <h3 class="col">Trucks</h3>
                <div class="ks-controls">
                    <button class="btn btn-success" data-toggle="modal" data-target="#showAddTruck">
                        <span class="la la-plus ks-icon"></span>
                        <span class="ks-text">Add Truck</span>
                    </button>
                </div>
            </div>
            <div class="card">
            <div class="card-block table-responsive">
                    <table class="table table-striped table-bordered dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trucks as $truck)
                        <tr>
                            <td>{{ $truck->id() }}</td>
                            <td>{{ $truck->number }}</td>
                            <td>{{ $truck->type }}</td>
                            <td>{{ $truck->status() }}</td>
                            <td>
                                <a href="{{ url("trucks/{$truck->id}") }}" class="btn btn-sm btn-primary">
                                    <span>View</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
               </div>
            </div>

        </div>
    </div>
    @include('trucks.modals._create')

@append
