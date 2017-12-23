@component('modals.modal')
@slot('id') updateOrder-{{$order->id}} @endslot
@slot('title') Update Order @endslot
@slot('footer') @endslot
<form action="{{ url("trips/{$trip->id}/orders/{$order->id}") }}" class="form" method="post"> {!! csrf_field() !!}
    {!! method_field('PATCH') !!}
    @include('trips.orders.partials._create',['order'=>$order])
    <button class="btn btn-primary">
        <span class="ks-icon">
            <i class="la la-plus"></i>
        </span>
        <span class="ks-text">Update</span>
    </button>
</form>
@endcomponent
