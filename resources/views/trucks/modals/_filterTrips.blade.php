 @component('modals.modal')
     @slot('id') filterTrips @endslot
     @slot('title') Filter Trips @endslot
     @slot('footer') @endslot
     <div class="row">
         <div class="col-md-4 push-lg-4">
            <form>
                <div class="form-group row">
                    <label for="default-input" class="col-sm-2 form-control-label">Start</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="start" id="start" placeholder="Start" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="default-input" class="col-sm-2 form-control-label">End</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="end" id="end" placeholder="End" autocomplete="off" required>
                    </div>
                </div>
                <button class="btn btn-primary">
                    <span class="la la-calendar ks-icon"></span>
                    <span class="ks-text">Filter</span>
                </button>
            </form>
         </div>
     </div>

@endcomponent

@section('scripts')
    <script>
        $('#start, #end').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
    </script>
@append
