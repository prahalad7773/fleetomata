@component('modals.modal')
    @slot('id') createOrder @endslot
    @slot('title') Create a new Order @endslot
    @slot('footer') @endslot
    @include('trips.orders.partials._create')
@endcomponent
