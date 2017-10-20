

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

                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Fri</th>
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
	                                        <button class="shortdate text-muted">Detail</button>
	                                	</td>
                                	 @endforeach
                                </tr>
                            </tbody>
                        </table>

                        

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

@include('pages.test')

@section('script')
    <script>
        document.getElementById("datepicker").onchange = function() {myFunction()};
        function myFunction() {
           
           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            var x = document.getElementById('datepicker').value;

            document.getElementById("demo").innerHTML = x;
           $.ajax({
               type:'GET',
               url:'timesheet/'+x,
               
               success:function(data){
                    // alert(data);
                    $('#ajax_data').html(data);
               }
            });
        }
    </script>
@endsection


