@component('modals.modal')
    @slot('id') createOrder @endslot
    @slot('title') Create a new Order @endslot
    @slot('footer') @endslot
<form action="{{ url("trips/{$trip->id}/orders") }}" class="form" method="post"> {!! csrf_field() !!}
    @include('trips.orders.partials._create',['order'=>new \App\Models\Trips\Order(['when'=>\Carbon\Carbon::now()->format('d-m-Y g:i A')])])
    <button class="btn btn-primary" id="submitBtn">
        <span class="ks-icon">
            <i class="la la-plus"></i>
        </span>
        <span class="ks-text">Create</span>
    </button>
</form>
@endcomponent
