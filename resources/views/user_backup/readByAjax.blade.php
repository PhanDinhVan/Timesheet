<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="admin_asset/vendors/dataTables/css/jquery.dataTables.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" charset="utf8" src="admin_asset/vendors/dataTables/js/jquery.dataTables.js"></script>
<!-- lam dep datatable -->
<link rel="stylesheet" type="text/css" href="admin_asset/vendors/dataTables/css/jquery.dataTables_themeroller.css">
<!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css"> -->

<table class="table" id="list_timesheet">
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
				<td>{{$value->projectname}}</td>
				<td>{{$value->taskname}}</td>
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

        $('#list_timesheet').dataTable({
                'paging':   true,  // Table pagination
                'ordering': true,  // Column ordering
                'info':     false,  // Bottom left status text
                'responsive': true, // https://datatables.net/extensions/responsive/examples/
                'bLengthChange': false, // hide records per page
                'searching': true, // hide Search
                  
                  // Text translation options
                  // Note the required keywords between underscores (e.g MENU)
            
                oLanguage: {
                    sSearch:      'Search: ',
                    sLengthMenu:  '_MENU_ records per page',
                    zeroRecords:  'Nothing found - sorry',
                    infoEmpty:    'No records available',
                    infoFiltered: '(filtered from MAX total records)'
                  },
                  // Datatable Buttons setup
                dom: '<"html5buttons"B>lTfgitp',
            columnDefs: [  
                
                // { "targets": [0],  // thu tu column
                //  "visible": true,  // cho phep hien thi
                //  "searchable": true, // cho phep search
                //  "orderable": false,  // cho phep sap xep
                //  "type": "string"
                // }, 

                // dinh nghia cho delete edit
                {   "targets": [6],
                    "orderable": false,
                    "type": "string"
                }, 
                {   "targets": [7],
                    "orderable": false,
                    "type": "string"
                }, 
                {   "targets": [8],
                    "orderable": false,
                    "type": "string"
                }      
           
                
                ],
                    buttons: [
                        {extend: 'copy',  className: 'btn-sm' },
                        {extend: 'csv',   className: 'btn-sm' },
                        {extend: 'excel', className: 'btn-sm', title: 'XLS-File'},
                        {extend: 'pdf',   className: 'btn-sm', title: $('title').text() },
                        {extend: 'print', className: 'btn-sm' }
                    ]
           
        });
    })

</script>

