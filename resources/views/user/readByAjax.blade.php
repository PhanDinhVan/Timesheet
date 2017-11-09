<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<!-- <input id="searchItem" type="search" name="searchItem" class="form-control" placeholder="Search"> -->
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
				<td class="working_time" style="text-align: center;">{{$value->working_time}}</td>
				<td class="overtime" style="text-align: center;">{{$value->overtime}}</td>
				<td class="date_time_entries" style="text-align: center;">{{$value->date_time_entries}}</td>
				<td style="text-align: center; padding-left: 2%;">
					<button value="{{$value->id}}" class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#popup-update">
						<span class="glyphicon glyphicon-edit"></span> Edit
					</button>
				</td>
				<td style="text-align: center; padding-left: 2%;">
					<button value="{{$value->id}}" class="btn btn-danger btn-sm btn-dell">
						<span class="glyphicon glyphicon-remove-circle"></span> Delete
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
 <!-- <div style="float: right;">{{ $timesheet->links() }}</div> -->


<script type="text/javascript">
	$(document).ready(function() {

 		$(".username").hide(); 
        var position = $("#position").val(); 
        if(position == 1){
         	$(".username").show(); 
        }

        // var working_time = $("#working_time").val();
        // setting working time
        var temp = $('table tbody .working_time');
        temp.each(function() {
            var a = $(this);
            var total_minutes = a.text();
            var hours = Math.floor(total_minutes/60);

            //format time 00:00
            var count = hours.toString().length;
            if(count < 2){
				hours = '0'+hours;
            }
           
            var minutes = total_minutes%60;
            var count2 = minutes.toString().length;
            if(count2 < 2){
				minutes = '0'+minutes;
            }

            working_time = hours + ':' + minutes;
            // alert(working_time);
            a.text(working_time);
        });

        // setting overtime
        var temp2 = $('table tbody .overtime');
        temp2.each(function() {
            var a = $(this);
            var total_minutes = a.text();
            var hours = Math.floor(total_minutes/60);

            //format time 00:00
            var count = hours.toString().length;
            if(count < 2){
				hours = '0'+hours;
            }
           
            var minutes = total_minutes%60;
            var count2 = minutes.toString().length;
            if(count2 < 2){
				minutes = '0'+minutes;
            }

            overtime = hours + ':' + minutes;
            // alert(working_time);
            a.text(overtime);
        });

        // setting date_time_entries
        var temp3 = $('table tbody .date_time_entries');
        temp3.each(function() {
            var a = $(this);
            var date_time = a.text();
            var myDate = new Date(date_time);
            var month =  myDate.getMonth() + 1;

		    var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
		    // alert(full_date);
		    a.text(full_date);

        });
    })
</script>

