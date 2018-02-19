<div class="row">
	<div class="col">
		<form method="post" class="form-inline" action="{{ url("trucks/{$truck->id}/expenses") }}">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="20%">When</th>
						<th width="20%">Type</th>
						<th width="20%">Amount</th>
						<th width="25%">Reason</th>
						<th width=""></th>
					</tr>
				</thead>
				<tr>
					<td>
						<div class="form-group @if($errors->has('when')) has-danger @endif">
						    <input type="text" class="form-control" style="width: 100%" required id="truckExpenseWhen" name="when" placeholder="Enter When" value="">
						    @if($errors->has('when'))
						        @foreach($errors->get('when') as $error)
						            <span class="help-block m-b-none">{{ $error }}</span>
						        @endforeach
						    @endif
						</div>
					</td>
					<td>
						<div class="form-group @if($errors->has('type')) has-danger @endif">
						    <select class="form-control" style="width: 100%" name="type">
						    	@foreach($newExpense->types() as $newExpense)
								<option value="{{ $newExpense }}">{{ $newExpense }}</option>
						    	@endforeach
						    </select>
						    @if($errors->has('type'))
						        @foreach($errors->get('type') as $error)
						            <span class="help-block m-b-none">{{ $error }}</span>
						        @endforeach
						    @endif
						</div>
					</td>
					<td>
						<div class="form-group @if($errors->has('amount')) has-danger @endif">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="la la-inr"></i>
								</span>
						    	<input type="number" min=0 step="0.01" class="form-control" style="width: 100%" required name="amount" placeholder="Enter Amount" value="">
							</div>
						    @if($errors->has('amount'))
						        @foreach($errors->get('amount') as $error)
						            <span class="help-block m-b-none">{{ $error }}</span>
						        @endforeach
						    @endif
						</div>
					</td>
					<td>
						<div class="form-group @if($errors->has('reason')) has-danger @endif">
						    <textarea class="form-control" style="width: 100%" required name="reason"></textarea>
						    @if($errors->has('reason'))
						        @foreach($errors->get('reason') as $error)
						            <span class="help-block m-b-none">{{ $error }}</span>
						        @endforeach
						    @endif
						</div>
					</td>
					<td>
						<button class="btn btn-primary">Create</button>
					</td>
				</tr>
			</table>
			{{ csrf_field() }}
		</form>
	</div>
</div>


<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th>ID</th>
			<th>When</th>
			<th>Type</th>
			<th>Amount</th>
			<th>Reason</th>
			<th>Created By</th>
			<th>Approved By</th>
		</tr>
	</thead>
	<tbody>
		@foreach($expenses as $expense)
		<tr>
			<td>{{ $expense->id() }}</td>
			<td>{{ $expense->when->format('d-m-Y') }}</td>
			<td>{{ $expense->type }}</td>
			<td><i class="la la-inr"></i> {{ $expense->amount }}</td>
			<td>{{ $expense->reason }}</td>
			<td>{{ $expense->createdBy }}</td>
			<td>{{ $expense->approvedBy }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@section('scripts')
	<script type="text/javascript">
		$('#truckExpenseWhen').daterangepicker({
			singleDatePicker : true,
			locale : {
				format : 'DD-MM-YYYY'
			}
		});
	</script>
@append