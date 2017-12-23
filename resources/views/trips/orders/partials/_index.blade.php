<div class="tab-pane ks-column-section" id="orders" role="tabpanel" aria-expanded="false">
    @foreach($orders->chunk(2) as $row)
    <div class="row">
        @foreach($row as $order)
            <div class="col-md-6">
                <div class="card panel panel-default ks-widget ks-widget-progress-list">
                    <div class="card-header">
                        {{ $order->id() }} -
                        {{ $order->customer() }}

                        <div class="ks-controls">
                            <a href="#" class="btn btn-sm ks-control" data-toggle="modal" data-target="#updateOrder-{{$order->id}}" data-order-id="{{$order->id}}">
                                <span class="ks-icon la la-edit"></span>
                            </a>
                            @include('modals.orders._update')
                            @role('admin')
                            <form action="{{ url("trips/{$trip->id}/orders/{$order->id}") }}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="ks-icon la la-trash btn-danger"></button>
                            </form>
                            @endrole
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="ks-item">
                            <div class="ks-info">
                                <div class="ks-wrapper">
                                    <div class="ks-text">
                                        <p><b>From : </b>{{ $order->loadingPoint }}</p>
                                        <p><b>To : </b>{{ $order->unloadingPoint }}</p>
                                        <p><b>Material : </b>{{ $order->material() }}</p>
                                        <p><b>When : </b>{{ $order->when() }}</p>
                                        <p><b>Remarks : </b>{{ $order->remarks }}</p>
                                    </div>
                                     <span class="text-muted">Created at : {{ $order->created_at->toDayDateTimeString() }}</span>
                                </div>
                                <span class="ks-percent"><i class="la la-inr"></i>{{ $order->hire }}</span>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        @endforeach
    </div>
    @endforeach
</div>
