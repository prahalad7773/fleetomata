@section('head')
<script src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
<link rel="stylesheet" type="text/css" href="/libs/bootstrap-daterange-picker/daterangepicker.css">

<style type="text/css">
.pac-container {
    /* put Google geocomplete list on top of Bootstrap modal */
    z-index: 9999;
}
</style>
@append
<form action="{{ url("trips/{$trip->id}/orders") }}" class="form" method="post"> {!! csrf_field() !!}
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="default-input" class="form-control-label">Customer Phone</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="la la-phone"></i>
                        </div>
                        <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Customer Phone" autocomplete="off" required>
                        <span class="input-group-btn">
                            <button id="customer_phone_button" class="btn btn-primary" type="button">Search!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
         <div class="col">
            <div class="form-group">
                <label for="default-input" class="form-control-label">Customer Name</label>
                <div class="">
                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" autocomplete="off" disabled required>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
             <div class="form-group">
                <label for="default-input" class="form-control-label">When</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                             <span class="i la la-calendar"></span>
                        </div>
                         <input type="text" class="form-control" name="when" id="when" placeholder="When" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Hire Amount</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="la la-inr"></span>
                        </div>
                        <input type="number" min="0" class="form-control" name="hire" id="hire" placeholder="Hire Amount" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Loading Point</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span><i class="la la-map-marker"></i></span>
                        </div>
                        <input type="text" class="form-control" name="loading_formatted" id="loading_formatted" placeholder="Loading Point" autocomplete="off" required>
                    </div>
                    <div id="loadingDetails" class="details hidden">
                        <input type="text" name="loading_place_id" data-geo="place_id" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Unloading Point</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span><i class="la la-map-marker"></i></span>
                        </div>
                        <input type="text" class="form-control" name="unloading_formatted" id="unloading_formatted" placeholder="Unloading Point" autocomplete="off" required>
                    </div>
                    <div id="unloadingDetails" class="details hidden">
                        <input type="text" name="unloading_place_id" data-geo="place_id" hidden>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Cargo</label>
                <div class="">
                    <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Weight</label>
                <div class="">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" name="weight" id="weight" placeholder="Weight" autocomplete="off" required>
                        <div class="input-group-addon">
                            <span>MT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button class="btn btn-primary" id="submitBtn">
        <span class="ks-icon">
            <i class="la la-plus"></i>
        </span>
        <span class="ks-text">Create</span>
    </button>
</form>
@section('scripts')
<script src={{ asset( 'js/jquery.geocomplete.min.js') }}></script>
<script src="/libs/momentjs/moment.min.js"></script>
<script src="/libs/bootstrap-daterange-picker/daterangepicker.js"></script>
<script>
    $('#when').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'DD-MM-YYYY h:mm A'
        }
    });
</script>
<script>
$('#loading_formatted').geocomplete({
    types: ["geocode", "establishment"],
    details: "#loadingDetails",
    detailsAttribute: "data-geo"
});
$('#unloading_formatted').geocomplete({
    types: ["geocode", "establishment"],

    details: "#unloadingDetails",
    detailsAttribute: "data-geo"
});

$('#customer_phone_button').on('click',function(e){
    e.preventDefault();
    $.get('/api/customers',{ 'phone' : $('#customer_phone').val() }, function(data){
        if(!data)
        {
            $('#customer_name').removeAttr('disabled');
            $('#customer_name').val(null);
        }else{
            $('#customer_name').val(data.name);
        }
    });
});

$('#submitBtn').on('click',function(e){
    var customerName = $('#customer_name');
    if(customerName.val() != ''){
        return
    }
    e.preventDefault();
});
</script>
@append
