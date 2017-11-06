<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Project name</th>
			<th>Task name</th>
			<th class="username">User name</th>
			<th style="text-align: center;">Working time</th>
			<th style="text-align: center;">Over time</th>
			<th style="text-align: center;">Date</th>
			<th style="text-align: center;">Edit</th>
			<th style="text-align: center;">Delete</th>
		</tr>
	</thead>
	<tbody>
		<input type="hidden" name="position" id="position" value="{{ Auth::user()->position }}">
		@foreach($timesheet as $key => $value)
			<tr class="id{{$value->id}}">
				<td>{{$value->id}}</td>
				<td class="projectname">{{$value->projectname}}</td>
				<td class="taskname">{{$value->taskname}}</td>
				<td class="username">{{$value->firstname}} {{$value->lastname}}</td>
				<td style="text-align: center;">{{$value->working_time}}</td>
				<td style="text-align: right;">{{$value->overtime}}</td>
				<td style="text-align: center;">{{$value->date_time_entries}}</td>
				<td style="text-align: right;">
					<button value="{{$value->id}}" class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#popup-update">
						<span class="glyphicon glyphicon-edit"></span> Edit
					</button>
				</td>
				<td style="text-align: right;">
					<button value="{{$value->id}}" class="btn btn-danger btn-sm btn-dell">
						<span class="glyphicon glyphicon-remove-circle"></span> Delete
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>


<script type="text/javascript">
	$(document).ready(function() {

 		$(".username").hide(); 
        var position = $("#position").val(); 
        if(position == 1){
        	$(".username").show(); 
        }
    })
</script>

