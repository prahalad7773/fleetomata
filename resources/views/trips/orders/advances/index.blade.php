@extends('layouts.app') @section('content')
<div class="ks-page-content-body" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row justify-content-md-space-around" style="margin-bottom: 15px;">
                <h3 class="col">Pending Advances - <i class="la la-inr"></i> {{ $ledgers->sum('amount') }}</h3>
            </div>
        <div class="row">
            <div class="col">
                <div class="card-block table-responsive">
                    <ledger-table :approvals="{{ $ledgers }}"></ledger-table>
                </div>
            </div>
        </div>
    </div>
</div>
@append
