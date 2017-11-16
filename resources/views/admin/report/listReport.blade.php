<table class="table table-hover table-striped table-condensed" id="report_info">
	<thead>
		<tr>
			<!-- <th>No</th> -->
			<th>Username</th>
			<th>Project Name</th>
			<!-- <th>Task Name</th> -->
			<th style="text-align: center;">Time</th>
		</tr>
	</thead>

	<tbody>
		@foreach($report as $key => $value)
			<tr>
				<!-- <td>{{ ++$key }}</td> -->
				<td class="fullname">{{ $value->firstname }} {{ $value->lastname }}</td>
				<td class="projectname">{{ $value->name }}</td>
				<!-- <td>{{ $value->taskname }}</td> -->
				<td style="text-align: center;"> {{ $value->total_working_time}} </td>
			</tr>
		@endforeach
	</tbody>
</table>


<table id="report_info2" style="display: none;">
	@foreach($report2 as $key2 => $value2)
		<tr>
			<td class="total">{{$value2->total_time}}</td>
		</tr>
	@endforeach
</table>

<!-- <table id="sum_table" width="300" border="1">
        <tr class="titlerow">
            <td>Apple</td>
            <td>Orange</td>
            <td>Watermelon</td>
        </tr>
        <tr>
            <td class="rowDataSd">1</td>
            <td class="rowDataSd">2</td>
            <td class="rowDataSd">3</td>
        </tr>
        <tr>
            <td class="rowDataSd">1</td>
            <td class="rowDataSd">2</td>
            <td class="rowDataSd">3</td>
        </tr>
        <tr>
            <td class="rowDataSd">1</td>
            <td class="rowDataSd">5</td>
            <td class="rowDataSd">3</td>
        </tr>
        <tr class="totalColumn">
            <td class="totalCol">Total:</td>
            <td class="totalCol">Total:</td>
            <td class="totalCol">Total:</td>
        </tr>
    </table> 
<script>
       var totals=[0,0,0];
        $(document).ready(function(){

            var $dataRows=$("#sum_table tr:not('.fullname, .projectname')");

            $dataRows.each(function() {
                $(this).find('.rowDataSd').each(function(i){        
                    totals[i]+=parseInt( $(this).html());
                });
            });
            $("#sum_table td.totalCol").each(function(i){  
                $(this).html("total:"+totals[i]);
            });

        });
</script> -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){

		var span = 1;
	   	var prevTD = "";
	   	var prevTDVal = "none";
	   	var old_span = 0;
	   	var temp = 0;

	   	

	  	$("#report_info tbody tr td:first-child").each(function() { //for each first td in every tr
	      	var $this = $(this);
	      	if ($this.text() == prevTDVal) { // check value of previous td text
	         	span++;
	         	if (prevTD != "") {
	            	prevTD.attr("rowspan", span); // add attribute to previous td
	            	$this.remove(); // remove current td
	         	}
	      	} else {
	      	
	      		if(prevTDVal == "none") {

	      		} else {
	      			
	      			old_span += span;

	      			// NOT DONT
	     //  			if(temp != old_span){
	     //  				var b;
	     //  				var j = 1;
				  //    	var $dataRows=$("#report_info2 tr:nth-child(" + j + ")");
						// $dataRows.each(function() {
				  //           $(this).find('.total').each(function(i){
				  //           	b =  $(this).html();
				  //           	alert(b);       
				  //           });
				  //           j++;
				  //   	});

						// $("#report_info tbody tr td.totalCol1").each(function(i){  
				  //       	$(this).html(b);
				  //   	});
	     //  			}
	      			// console.log(prevTDVal + span + "  ___" + old_span);

	      			var newItem = "<tr style='background:#ccefff;'><td>" + 'Total Time' + "</td>" + "<td>" + '' + "</td>" + "<td class='totalCol1' style='text-align: center;'>" + old_span + "</td></tr>";
	      			$('#report_info tbody tr:nth-child('+old_span+')').after(newItem);
	      			old_span += 1;
	      			temp = old_span;
	      		}

	         	prevTD     = $this; // store current td 
	         	prevTDVal  = $this.text();
	         	span       = 1;
	      	}
	   });
	  	var newItem = "<tr style='background:#ccefff;'><td>" + 'Total Time' + "</td>" + "<td>" + '' + "</td>" + "<td class='totalCol' style='text-align: center;'>" + 'value' + "</td></tr>"; 
		$("#report_info tbody tr:last").after(newItem);

		// add total time row last
		var a;
		var $dataRows=$("#report_info2 tr");
			$dataRows.each(function() {
	            $(this).find('.total').each(function(i){
	            	a =  $(this).html();
	            });
        	});

			$("#report_info tbody td.totalCol").each(function(i){  
            	$(this).html(a);
        	});

		// add total time row fisrt and next
        

	})

</script>