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
                        <th width="200">Approval</th>
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
                                        @foreach($accounts as $account)
                                        <option value="{{ $account }}">{{ $account }}</option>
                                        @endforeach
                                        @foreach($orders as $order)
                                        <option value="{{ $order->customer }}">{{ $order->customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="to" id="to" class="form-control">
                                        @foreach($accounts as $account)
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
                            <i class="la la-inr"></i> {{ $ledger->amount }}
                        </td>
                        <td>{{ $ledger->reason }}</td>
                        <td>
                            @if(!$ledger->approval)
                            <form action="{{ url("trips/{$trip->id}/ledgers/{$ledger->id}") }}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('PATCH') !!}
                                <input type="text" hidden name="type" value="approval">
                                <button class="btn btn-primary">
                                    <i class="la la-check"></i>
                                </button>
                            </form>
                            @else
                            {{ $ledger->approvalStatus() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
