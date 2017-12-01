<table>
	<thead>
		<tr>
			<th>Truck</th>
			<th>totalTurnOver</th>
			<th>totalExpense</th>
			<th>totalProfit</th>
			<th>totalKMs</th>
			<th>averageMileage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($topSheetItems as $item)
		<tr>
			<td>{{ $item->truck->number }}</td>
			<td>{{ $item->totalTurnOver }}</td>
			<td>{{ $item->totalExpense }}</td>
			<td>{{ $item->totalProfit }}</td>
			<td>{{ $item->totalKMs }}</td>
			<td>{{ $item->averageMileage }}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td>Summary</td>
			<td>{{ $topSheetItems->sum('totalTurnOver') }}</td>
			<td>{{ $topSheetItems->sum('totalExpense') }}</td>
			<td>{{ $topSheetItems->sum('totalProfit') }}</td>
			<td>{{ $topSheetItems->sum('totalKMs') }}</td>
			<td>{{ $topSheetItems->average('averageMileage') }}</td>
		</tr>
	</tfoot>
</table>
