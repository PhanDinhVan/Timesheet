<table class="table table-hover table-striped table-condensed" id="report_info">
	<thead>
		<tr>
			<th>No</th>
			<th>Customer Name</th>
			<th>Project Name</th>
			<th>Task Name</th>
			<th>Username</th>
			<th style="text-align: center;">Total Time</th>
		</tr>
	</thead>

	<tbody>
		@foreach($report as $key => $value)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $value->customer_name }}</td>
				<td>{{ $value->project_name }}</td>
				<td>{{ $value->taskname }}</td>
				<td>{{ $value->firstname }} {{ $value->lastname }}</td>
				<td class="working_time" style="text-align: center;"> {{ $value->working_time + $value->overtime}} </td>
			</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		$('#report_info').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			]
			// buttons: [
	  //           {
	  //               text: 'My button',
	  //               action: function ( e, dt, node, config ) {
	  //                   alert( 'Button activated' );
	  //               }
	  //           }
   //      	]
		});

    // 	var temp2 = $('.working_time');
    //     temp2.each(function() {
    //         var a = $(this);
    //         var total_minutes = a.text();
    //         var hours = Math.floor(total_minutes/60);

    //         //format time 00:00
    //         var count = hours.toString().length;
    //         if(count < 2){
				// hours = '0'+hours;
    //         }
           
    //         var minutes = total_minutes%60;
    //         var count2 = minutes.toString().length;
    //         if(count2 < 2){
				// minutes = '0'+minutes;
    //         }

    //         working_time = hours + ':' + minutes;
    //         // alert(working_time);
    //         a.text(working_time);
    //     });
	})

	
</script>