<div class="row">
	<div class="col">
		<form method="post" action="{{ url("trucks/{$truck->id}/") }}">
			
			<div class="form-group @if(->has('when')) has-danger @endif">
			    <label for="when">When</label>
			    <input type="text" class="form-control" required name="when" placeholder="Enter When" value="">
			    @if(->has('when'))
			        @foreach(->get('when') as )
			            <span class="help-block m-b-none">{{  }}</span>
			        @endforeach
			    @endif
			</div>
			<div class="form-group @if(->has('type')) has-danger @endif">
			    <label for="type">Type</label>
			    <select class="form-control">
			    	@foreach($newExpense->types as $newExpense)
					<option value="{{ $newExpense }}">{{ $newExpense }}</option>
			    	@endforeach
			    </select>
			</div>
			<div class="form-group @if(->has('amount')) has-danger @endif">
			    <label for="amount">Amount</label>
			    <input type="text" class="form-control" required name="amount" placeholder="Enter Amount" value="">
			    @if(->has('amount'))
			        @foreach(->get('amount') as )
			            <span class="help-block m-b-none">{{  }}</span>
			        @endforeach
			    @endif
			</div>
			<div class="form-group @if(->has('reason')) has-danger @endif">
			    <label for="reason">Reason</label>
			    <input type="text" class="form-control" required name="reason" placeholder="Enter Reason" value="">
			    @if(->has('reason'))
			        @foreach(->get('reason') as )
			            <span class="help-block m-b-none">{{  }}</span>
			        @endforeach
			    @endif
			</div>
	
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