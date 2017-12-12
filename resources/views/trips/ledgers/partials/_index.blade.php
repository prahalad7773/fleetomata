@if($showForm)

    @if($trip->isActive() || auth()->user()->hasRole('admin'))

        @include("trips.ledgers.partials._create")

    @endif

@endif
<table class="table table-striped table-bordered dataTable" style="min-width: 600px">
    <thead>
        <tr>
            <th width="100">When</th>
            @if($showOrder)
            <th>Trip</th>
            <th>Order</th>
            @endif
            <th width="100">From</th>
            <th width="100">To</th>
            <th width="100">Amount</th>
            <th width="100">Reason</th>
            <th width="100">Approval</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ledgers as $ledger)
        <tr>
            <td>{{ $ledger->when->toDayDateTimeString() }}</td>
            @if($showOrder)
            <td>
                <a href="{{ url("trips/{$ledger->trip->id}") }}">
                {{ $ledger->trip }}
                </a>
            </td>
            <td>
                <b>{{ $ledger->trip->truck }}</b>
                <ul>
                    @foreach($ledger->trip->orders as $order)
                    <li>{{ $order }}</li>
                    @endforeach
                </ul>
            </td>
            @endif
            <td>{{ $ledger->fromable }}</td>
            <td>{{ $ledger->toable }}</td>
            <td>
                <i class="la la-inr"></i> {{ $ledger->amount }}
            </td>
            <td>{{ $ledger->reason }}</td>
            <td class="">
                <div class="ks-items-block">
                    <div class="row">
                        <div class="col">
                            <button class="badge badge-default">{{ $ledger->approvalStatus() }}</button>
                        </div>
                        <div class="col">
                            @if(!$ledger->approval)
                            <form action="{{ url("trips/{$ledger->trip_id}/ledgers/{$ledger->id}") }}" method="post">
                                {!! csrf_field() !!} {!! method_field('PATCH') !!}
                                <input type="text" hidden name="type" value="approval">
                                <button class="badge badge-primary" type="submit">
                                    <span class="ks-icon la la-check"></span>
                                </button>
                            </form>
                            @endif
                        </div>
                        <div class="col">
                            <form action="{{ url("trips/{$ledger->trip_id}/ledgers/{$ledger->id}") }}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="badge badge-danger" type="submit">
                                    <span class="ks-icon la la-trash"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
