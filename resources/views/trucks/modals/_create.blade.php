@component('modals.modal')
    @slot('id') showAddTruck @endslot
    @slot('title') Create new Truck @endslot
    @slot('footer')  @endslot
    <form action="{{ url('trucks') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group @if($errors->has('number')) has-danger @endif">
            <label for="number">Number</label>
            <input type="text" class="form-control" required name="number" placeholder="Enter Number" value="">
            @if($errors->has('number'))
                @foreach($errors->get('number') as $error)
                    <span class="help-block m-b-none">{{ $error }}</span>
                @endforeach
            @endif
        </div>
        <div class="form-group @if($errors->has('type')) has-danger @endif">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value=""></option>
                <option value="24ft SXL Container">24ft SXL Container</option>
                <option value="32ft MXL Container">32ft MXL Container</option>
            </select>
            @if($errors->has('type'))
                @foreach($errors->get('type') as $error)
                    <span class="help-block m-b-none">{{ $error }}</span>
                @endforeach
            @endif
        </div>
        <button class="btn btn-primary">
            <span class="la la-plus ks-icon"></span>
            <span class="ks-text">Add Truck</span>
        </button>
    </form>
@endcomponent
