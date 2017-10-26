<div class="tab-pane ks-column-section" id="orders" role="tabpanel" aria-expanded="false">
    @foreach($orders->chunk(2) as $row)
    <div class="row">
        @foreach($row as $order)
            <div class="col-md-6">
                <div class="card panel panel-default ks-widget ks-widget-progress-list">
                    <div class="card-header">
                        {{ $order->id() }} -
                        {{ $order->customer }}
                        <div class="ks-controls">
                            <a href="#" class="ks-control ks-update"><span class="ks-icon la la-refresh"></span></a>
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
                                        <p><b>Contact : </b>+91 {{ $order->customer->phone }}</p>
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
