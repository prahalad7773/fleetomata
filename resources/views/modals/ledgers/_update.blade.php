@component('modals.modal')
@slot('id') updateLedger-{{$ledger->id}} @endslot
@slot('title') Update Ledger @endslot
@slot('footer') @endslot
<form action="{{ url("trips/{$ledger->trip_id}/ledgers/{$ledger->id}") }}" class="form" method="post"> {!! csrf_field() !!}
    {!! method_field('PATCH') !!}
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>When</label>
                <div class="">
                    <input type="text" class="form-control ledgerWhen" name="when" id="ledgerWhen" placeholder="When" autocomplete="off" value="{{$ledger->when}}" required>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Amount</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="la la-inr"></i>
                    </div>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off" value="{{$ledger->amount}}"  required>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Reason</label>
                <input type="text" class="form-control" name="reason" id="reason" placeholder="Reason" autocomplete="off" value="{{$ledger->reason}}" required>
            </div>
        </div>
    </div>
    <button class="btn btn-primary">
        <span class="ks-icon">
            <i class="la la-plus"></i>
        </span>
        <span class="ks-text">Update</span>
    </button>
</form>
@endcomponent