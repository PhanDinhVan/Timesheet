<table class="table table-hover table-striped table-condensed" id="report_info"> 
	<thead style="background: #ccefff; font-size: 15px;">
		<tr>
			<th class="th_username">Username</th>
			<th >Customer Name</th>
			<th>Project Name</th>
			<th class="time">Time</th>
			<th class="time">Total time</th>
		</tr>
	</thead>

	<tbody>
		@foreach($report as $key => $value)
			<tr>
				<td >{{ $value->firstname }} {{ $value->lastname }}</td>
				<td class="customer_name">{{ $value->customer_name }}</td>
				<td >{{ $value->name }}</td>
				<td class="working_time"> {{ $value->total_working_time}} </td>
				
				@foreach($report2 as $key2 => $value2)
					@if($value->ID == $value2->user_ID)
						<td class="total_time">{{$value2->total_time}}</td>
					@endif
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

<style type="text/css">
	.th_username{
		width: 35%;
	}
	.time{
		text-align: center; 
		width: 10%;
	}
	.working_time{
		text-align: center;
	}
	.total_time{
		text-align: center; 
		color:#3333ff; 
		font-weight: bold;
	}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){

		var span = 1;
	   	var prevTD = "";
	   	var prevTDVal = "none";
	   	var old_span = 0;
	   	
	   	// gom dong cua username
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

	  	// gom dong cua total time
	  	$("#report_info tbody tr td:last-child").each(function() { //for each first td in every tr
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

	  	// gom dong cua cot thu 2
	   	// $("#report_info tbody tr td.customer_name").each(function() { //for each first td in every tr
	    //   	var $this = $(this);
	    //   	if ($this.text() == prevTDVal) { // check value of previous td text
	    //      	span++;
	    //      	if (prevTD != "") {
	    //         	prevTD.attr("rowspan", span); // add attribute to previous td
	    //         	$this.remove(); // remove current td
	    //      	}
	    //   	} else {
	    //      	prevTD     = $this; // store current td 
	    //      	prevTDVal  = $this.text();
	    //      	span       = 1;
	    //   	}
	   	// });
		
	})

</script>