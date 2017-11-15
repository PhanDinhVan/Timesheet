<table class="table table-hover table-striped table-condensed" id="report_info">
	<thead>
		<tr>
			<!-- <th>No</th> -->
			<th>Customer Name</th>
			<th>Username</th>
			<th style="text-align: center;">Total Time</th>
		</tr>
	</thead>

	<tbody>
		@foreach($report as $key => $value)
			<tr>
				<!-- <td>{{ ++$key }}</td> -->
				<td>{{ $value->customer_name }}</td>
				<td>{{ $value->firstname }} {{ $value->lastname }}</td>
				<td style="text-align: center;"> {{ $value->total_working_time}} </td>
			</tr>
		@endforeach
	</tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var span = 1;
	   	var prevTD = "";
	   	var prevTDVal = "";
	  	$("#report_info tbody tr td:first-child").each(function() { //for each first td in every tr
	      	var $this = $(this);
	      	if ($this.text() == prevTDVal) { // check value of previous td text
	         	span++;
	         	if (prevTD != "") {
	            	prevTD.attr("rowspan", span); // add attribute to previous td
	            	$this.remove(); // remove current td
	         	}
	      	} else {
	         	prevTD     = $this; // store current td 
	         	prevTDVal  = $this.text();
	         	span       = 1;
	      	}
	   	});

		// $('#report_info').DataTable({
		// 	dom: 'Bfrtip',
		// 	buttons: [
		// 		'copyHtml5',
		// 		'excelHtml5',
		// 		'csvHtml5',
		// 		'pdfHtml5'
		// 	]
		// });
	})

	
</script>