<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>




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
                                <tr style="text-align: center; font-size: 14px;">
                                    <td>Project name</td>
                                    <td>Task name</td>
                                    <td>Working time</td>
                                    <td>Over time</td>
                                    <td>Date</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($time_entries as $value)
                                    <tr>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span class="projectname">{{$value->task_id}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span class="taskname">{{$value->task_id}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                             <div class="shortdate text-muted"><span>{{$value->working_time}}</span></div>
                                        </td class="agenda-date">
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span>{{$value->overtime}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span>{{$value->date_time_entries}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <button class="shortdate text-muted" type="button" data-toggle="modal" data-target="#edit">
                                                Edit
                                            </button>
                                        </td>
                                        <td class="agenda-date">
                                            <button class="shortdate text-muted" type="button" data-toggle="modal" data-target="#delete">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('pages.test')
                        @include('pages.edit_timesheet')

                    </div>
                </div>
            </div>
        <!-- /.container -->
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

            // get data khi thay doi date
           $.ajax({
                type:'GET',
                url:'users/timesheet/'+create_date,
                success:function(data){

                    var temp = jQuery.parseJSON(data);

                    temp.forEach(function(element) {

                        innerHtml = '<tr>' + 
                            '<td class="agenda-date">' + 
                                '<div class="shortdate text-muted">' + '<span class="projectname_1">' + element.task_id + '</span>' + '</div>' +
                            '</td>' +
                            '<td class="agenda-date">' + 
                                '<div class="shortdate text-muted"><span class="taskname_1">' + element.task_id + '</span>' + '</div>' +
                            '</td>' +
                            '<td class="agenda-date">' +
                                 '<div class="shortdate text-muted">' + '<span>' + element.working_time + '</span>' + '</div>' +
                            '</td class="agenda-date">' +
                            '<td class="agenda-date">' +
                                '<div class="shortdate text-muted">' + '<span>' + element.overtime + '</span>' + '</div>' +
                            '</td>' +
                            '<td class="agenda-date">' +
                                '<div class="shortdate text-muted">' + '<span>' + element.date_time_entries + '</span>' + '</div>' +
                            '</td>' +
                            '<td class="agenda-date">' +
                                '<button class="shortdate text-muted" type="button" data-toggle="modal" data-target="#edit">Edit</button>' +
                            '</td>' + 
                            '<td class="agenda-date">' + 
                                '<button class="shortdate text-muted" type="button" data-toggle="modal" data-target="#delete">Delete</button>' +
                            '</td>' +
                        '</tr>'
                        $('#ajax_data').append(innerHtml);
                    });

                    //show task name when change date
                    var temp_change = $('.agenda-date > div .taskname_1');
                    // console.log(temp_change);
                    temp_change.each(function() {
                        var a = $(this);
                        var task_id = a.text();
                        // alert(task_id);
                        $.get("taskname/"+task_id, function(data){
                            // alert(data);
                            a.text(data);
                        });
                    });

                    // show project name when change date
                    var temp = $('.agenda-date > div .projectname_1');
                    temp.each(function() {
                        var a = $(this);
                        var task_id = a.text();
                        // get project name
                        $.get("projectname/"+task_id, function(data){
                            // alert(data);
                            a.text(data);
                        });
                    });
                }
            });

           // an table 1 hien thi table 2
           document.getElementById("tab1").style.display = "none";
           document.getElementById("tab2").style.display = "";
        }

        // show taskname dung voi tung projectname trong modal
        $(document).ready(function(){
            $("#project").change(function(){
                var project_id = $(this).val();
                $.get("task/"+project_id, function(data){
                    $("#task").html(data);
                    // alert(data);
                });
            });
        });

        // show taskname dung voi tung projectname khi edit timesheet
        $(document).ready(function(){
            $("#project_edit").change(function(){
                var project_id = $(this).val();
                $.get("task_edit/"+project_id, function(data){
                    $("#task_edit").html(data);
                    // alert(data);
                });
            });
        });

        // show task name when first load page timesheet
        $(document).ready(function(){
            
            function getTaskname(){

                // jQuery get taskname
                var temp = $('.agenda-date > div .taskname');
                temp.each(function() {
                    var a = $(this);
                    var task_id = a.text();
                    // alert(task_id);
                    $.get("taskname/"+task_id, function(data){
                        // alert(data);
                        a.text(data);
                    });

                // var temp = document.getElementByClass('taskname').innerHTML;
                // var task_id = temp.match(/\d+/g).map(Number);
                // // alert(task_id);
                // $.get("taskname/"+task_id, function(data){
                //     // alert(data);
                //     $(".taskname").html(data);
                // });

                });
             }
            getTaskname();


            function getProjectName(){

                // jQuery get task_id -> get project name
                var temp = $('.agenda-date > div .projectname');
                temp.each(function() {
                    var a = $(this);
                    var task_id = a.text();
                    // get project name
                    $.get("projectname/"+task_id, function(data){
                        // alert(data);
                        a.text(data);
                    });
                });
             }
            getProjectName();
        });

    </script>
@endsection

