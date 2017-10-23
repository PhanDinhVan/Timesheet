

 <style>
    .agenda {}
    /* Dates */
    
    .agenda .agenda-date {
        width: 170px;
    }
    
    .agenda .agenda-date .dayofmonth {
        width: 40px;
        font-size: 36px;
        line-height: 36px;
        float: left;
        text-align: right;
        margin-right: 10px;
    }
    
    .agenda .agenda-date .shortdate {
        font-size: 0.75em;
    }

</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<p id="demo"></p>
<div class="container">
        <h1 class="thick-heading" style="text-align: center;">Timesheet</h1>
        <!-- First Featurette -->
        <div class="featurette" id="about">
            <div class="container">
                <div class="agenda">
                    <div class="table-responsive">
                    	<div class="form-group">

						    <label>Today</label>
							<input class="date form-control" type="text" id="datepicker" style="width: 9%;">
						</div>
						<!-- datepicker -->
						<script type="text/javascript">
							$("#datepicker").datepicker({format: 'yyyy-mm-dd'}).datepicker("setDate", new Date());
						    $('.date').datepicker({  
						       format: 'yyyy-mm-dd'
						     });  
						</script>

                        <table class="table table-condensed table-bordered" id="tab1">
                            <thead>
                                <tr>
                                    <th id="dayofweek"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                	 @foreach($time_entries as $value)
	                                	<td class="agenda-date" class="active" rowspan="1">
	                                		<div class="shortdate text-muted">Project name: {{$value->create_date}}</div>
	                                        <div class="shortdate text-muted">Task name: {{$value->task_id}}</div>
	                                        <div class="shortdate text-muted">Working time: {{$value->working_time}}</div>
	                                        <div class="shortdate text-muted">Over time: {{$value->overtime}}</div>
	                                        <div class="shortdate text-muted">Start date: {{$value->start_date}}</div>
	                                        <button class="shortdate text-muted" >Detail</button>
	                                	</td>
                                	 @endforeach
                                </tr>
                            </tbody>
                        </table>
                        @include('pages.test')

                        

                    </div>
                </div>
            </div>
        <!-- /.container -->
        <!-- jQuery -->
        <script src="http://www.tutorialspoint.com/bootstrap/scripts/jquery.min.js">
        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="http://www.tutorialspoint.com/bootstrap/js/bootstrap.min.js">
        </script>
    </div>



@section('script')
    <script>
        //Hien thi thu trong tuan 
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";

        var n = weekday[d.getDay()];
        document.getElementById("dayofweek").innerHTML = n;

        // Khi click change date
        document.getElementById("datepicker").onchange = function() {myFunction()};
        function myFunction() {

            // dung de clear cac column add truoc do
            $("#ajax_data").empty();
           
           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            // create_date hien thi thu trong tuan khi change date va dung trong ajax
            var create_date = document.getElementById('datepicker').value;
            var d = new Date(create_date);
            var weekday = new Array(7);
            weekday[0] = "Sunday";
            weekday[1] = "Monday";
            weekday[2] = "Tuesday";
            weekday[3] = "Wednesday";
            weekday[4] = "Thursday";
            weekday[5] = "Friday";
            weekday[6] = "Saturday";

            var n = weekday[d.getDay()];
            document.getElementById("dayofweek_change").innerHTML = n;  

            // document.getElementById("demo").innerHTML = x;
            // get data khi thay doi date
           $.ajax({
               type:'GET',
               url:'timesheet/'+create_date,
               
                success:function(data){

                    var temp = jQuery.parseJSON(data);


                    temp.forEach(function(element) {

                        innerHtml = '<td class="agenda-date" class="active" rowspan="1">' 
                        + '<div class="shortdate text-muted">' + 'Project name:' + element.create_date + '</div>' 
                        + '<div class="shortdate text-muted">' + 'Task name:' + element.task_id + '</div>'
                        + '<div class="shortdate text-muted">' + 'Working time:' + element.working_time + '</div>'
                        + '<div class="shortdate text-muted">' + 'Over time:' + element.overtime + '</div>'
                        + '<div class="shortdate text-muted">' + 'Start date:' + element.start_date + '</div>'
                        + '<button class="shortdate text-muted">' + 'Detail' + '</button>'
                        + '</td>'
                        // add one column in ajax
                        $('#ajax_data').append(innerHtml);

                    });
                }
            });

           // an table 1 hien thi table 2
           document.getElementById("tab1").style.display = "none";
           document.getElementById("tab2").style.display = "";
        }

       
    </script>
@endsection



