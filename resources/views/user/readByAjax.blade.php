<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Project name</th>
			<th>Task name</th>
			<th>Working time</th>
			<th>Over time</th>
			<th>Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach($timesheet as $key => $value)
			<tr class="id{{$value->id}}">
				<td>{{$value->id}}</td>
				<td>{{$value->project_id}}</td>
				<td>{{$value->task_id}}</td>
				<td>{{$value->working_time}}</td>
				<td>{{$value->overtime}}</td>
				<td>{{$value->date_time_entries}}</td>
				<td><button value="{{$value->id}}" class="btn btn-primary btn-sm btn-edit"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>
				<td><button value="{{$value->id}}" class="btn btn-danger btn-sm btn-dell"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button></td>
			</tr>
		@endforeach
	</tbody>
</table>

