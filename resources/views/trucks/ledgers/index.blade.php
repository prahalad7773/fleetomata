@extends('layouts.app')

@section('content')

    <div class="ks-page-content-body" style="padding-top: 0px;">
        <div class="container-fluid">
            <div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
                <h3 class="col">Ledgers for - {{ $truck->number }}</h3>
            </div>
            <div class="row">
                <div class="col">
                    @include('trips.ledgers.partials._index',[
                        'showForm' => false,
                        'showOrder' => true,
                    ])
                </div>
            </div>    
        </div>
    </div>

@endsection

