 @component('modals.modal')
        @slot('id') createTrip @endslot
        @slot('title') Create A trip for the truck @endslot
        @slot('footer')  @endslot
        <form action="{{ url("trips") }}" method="post">
            {!! csrf_field() !!}
            <input type="text" value="{{ $truck->id }}" name="truck_id" hidden>
            <div class="form-group @if($errors->has('started_at')) has-danger @endif">
                <label for="started_at">Started At</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="la la-calendar"></i>
                    </span>
                    <input type="text" id="started_at" class="form-control" required name="started_at"
                           placeholder="Enter started At" value="">
                </div>
                @if($errors->has('started_at'))
                    @foreach($errors->get('started_at') as $error)
                        <span class="help-block m-b-none">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
            <button class="btn btn-success">
                <span class="la la-plus ks-icon"></span>
                <span class="ks-text">Create Trip</span>
            </button>
        </form>
    @endcomponent

@section('scripts')
<script>
    $('#started_at').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'DD-MM-YYYY h:mm A'
            }
        });
</script>
@append
