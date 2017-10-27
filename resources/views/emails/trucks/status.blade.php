@component('mail::message')
Truck Status - {{ Carbon\Carbon::now()->toDayDateTimeString() }}
----------
## Empty Trucks
@forelse($emptyTrucks as $truck)
- {{ $truck->number }}
@empty
- No Empty Truck
@endforelse

## Trucks in Transit
@forelse($transitTrucks as $truck)
- {{ $truck->number }} - Trip Days : {{ $truck->activeTrip->tripDays() }}
@foreach($truck->activeTrip->orders as $order)
  * {{ $order }}
@endforeach
@empty
- No Trucks in Transit
@endforelse

Thanks,<br>
{{ config('app.name') }}
@endcomponent
