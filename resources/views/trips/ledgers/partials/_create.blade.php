<form action="{{ url("trips/{$trip->id}/ledgers") }}" method="post"> {!! csrf_field() !!}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>When</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Reason</th>
                <th width="200">Approval</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group">
                        <div class="">
                            <input type="text" class="form-control ledgerWhen" name="when" id="ledgerWhen" placeholder="When" autocomplete="off" required>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select name="from" id="from" class="form-control">
                            @foreach($accounts as $account)
                            <option value="{{ json_encode([
                                    'id' => $account->id,
                                    'type' => get_class($account)
                                ]) }}">{{ $account }}</option>
                            @endforeach @foreach($orders as $order)
                            <option value="{{ json_encode([
                                    'id' => $order->id,
                                    'type' => get_class($order)
                                ]) }}">{{ $order }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select name="to" id="to" class="form-control">
                            @foreach($accounts as $account)
                            <option value="{{ json_encode([
                                    'id' => $account->id,
                                    'type' => get_class($account)
                                ]) }}">{{ $account }}</option>
                            @endforeach @foreach($orders as $order)
                            <option value="{{ json_encode([
                                    'id' => $order->id,
                                    'type' => get_class($order)
                                ]) }}">{{ $order }}</option>
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
        </tbody>
    </table>
</form>
