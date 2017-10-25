@component('modals.modal')
	@slot('id') completeTrip @endslot
	@slot('title') Complete Trip @endslot
	@slot('footer') @endslot
	<form action="{{ url("trips/{$trip->id}") }}" method="post">
		{!! csrf_field() !!}
		{!! method_field('put') !!}
		 <div class="form-group row">
		    <label for="default-input" class="col-sm-2 form-control-label">Completed At</label>
		    <div class="col-sm-10">
		        <div class="input-group">
		        	<div class="input-group-addon">
		        		<span class="i la la-calendar"></span>
		        	</div>
		        	<input type="text" class="form-control" name="completed_at" id="completed_at" placeholder="Completed At" autocomplete="off" required>
		        	<div class="input-group-btn">
		        		<button href="#" class="btn btn-primary ks-control">
				            <span class="ks-icon la la-check"></span>
				            <span class="ks-text">Complete</span>
				        </button>
		        	</div>
		        </div>
		    </div>
		</div>

	</form>

@endcomponent

@section('scripts')
	<script>
		$('#completed_at').daterangepicker({
			singleDatePicker: true,
		    timePicker: true,
		    timePickerIncrement: 30,
		    locale: {
		        format: 'DD-MM-YYYY h:mm A'
		    }
		});
	</script>
@append
