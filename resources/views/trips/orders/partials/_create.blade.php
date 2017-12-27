    <div class="row">
        <div class="col">
             <div class="form-group">
                <label for="default-input" class="form-control-label">When</label>
                <div class="">
                    <div class="input-group">
                        <div class="input-group-addon">
                             <span class="i la la-calendar"></span>
                        </div>
                         <input type="text" class="form-control when" name="when" id="when" placeholder="When" autocomplete="off"
                               value="{{ $order->when }}" required>
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
                        <input type="number" min="0" class="form-control" name="hire" id="hire" placeholder="Hire Amount" autocomplete="off" value="{{$order->hire}}" required>
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
                        <input type="text" class="form-control loading" name="loading_formatted" id="loading_formatted" placeholder="Loading Point" autocomplete="off"
                               value="{{ optional($order->loadingPoint)->formatted_address }}" required>
                    </div>
                    <div id="loadingDetails" class="loading_details hidden">
                        <input type="text" name="loading_place_id" data-geo="place_id"
                        value="{{ optional($order->loadingPoint)->place_id }}" hidden>
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
                        <input type="text" class="form-control unloading" name="unloading_formatted" id="unloading_formatted" placeholder="Unloading Point" autocomplete="off"
                               value="{{optional($order->unloadingPoint)->formatted_address }}"  required>
                    </div>
                    <div id="unloadingDetails" class="unloading_details hidden">
                        <input type="text" name="unloading_place_id" data-geo="place_id"
                        value="{{optional($order->unloadingPoint)->place_id }}"  hidden>
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
                    <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" autocomplete="off" value="{{$order->cargo}}" required>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group  ">
                <label for="default-input" class=" form-control-label">Weight</label>
                <div class="">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" name="weight" id="weight" placeholder="Weight" autocomplete="off" value="{{$order->weight}}" required>
                        <div class="input-group-addon">
                            <span>MT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="form-control-label p-t-0">Type</label>
                <div class="">
                    <label class="custom-control custom-radio">
                        <input name="type" type="radio" value="0" class="custom-control-input" {{$order->type == 0 ? 'checked': ''}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Market Load</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input name="type" type="radio" value="1" class="custom-control-input" {{$order->type == 1 ? 'checked': ''}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">JSM</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input name="type" type="radio" value="2" class="custom-control-input" {{$order->type == 2 ? 'checked': ''}}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Empty</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col">
           <div class="form-group">
                <label for="default-input" class="form-control-label">Remarks</label>
                <div class="">
                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control">{{$order->remarks}}</textarea>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
<script>
    $('.when').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerIncrement: 05,
        locale: {
            format: 'DD-MM-YYYY h:mm A'
        }
    });
</script>
<script>
$('.loading').geocomplete({
    types: ["geocode", "establishment"],
    details: ".loading_details",
    detailsAttribute: "data-geo"
});
$('.unloading').geocomplete({
    types: ["geocode", "establishment"],

    details: ".unloading_details",
    detailsAttribute: "data-geo"
});


</script>
@append
