@extends('layout.index')

@include('layout.header')


@section('content')
<!-- Page Content --> 


<div class="row">
  	<div class="col-md-6">
    	
      	<div class="x_content">
        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#yourModal" id="add">
        		<i class="fa fa-plus pull-left" style="margin-top: 5%;"></i>Add Time
        	</button>
      	</div>
    </div>
    <div class="btn-group" data-toggle="buttons" style="float: right; padding-right: 2%;">
    	<label class="btn btn-default active">
      		<input type="radio" name="options" id="option1"> Day
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option2"> Week
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option3"> Month
    	</label>
  	</div>
               
</div>




<!-- Modal trong laravel -->

@include('pages.add_timesheet')
@include('pages.list_timesheet')
@include('pages.edit_timesheet')


<!-- /#page-wrapper -->	

@endsection

@section('script')
    <script>

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                                '<input class="term" type="hidden" value="' + element.id + '" />' +
                                '<button class="shortdate text-muted edit" type="button" data-toggle="modal">' + 
                                    '<a class="btn btn-success btn-xs" id="edit" data-id="' + element.id + '">Edit</a>' +
                                '</button>' +
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

                    // get project name when click edit timesheet
                    // $('.edit').click(function() {
                    //     var id = $(this).prev().attr("value");
                    //     // .attr("value");
                    //     alert(id);
                    // });
                }
            });

           // an table 1 hien thi table 2
           document.getElementById("tab1").style.display = "none";
           document.getElementById("tab2").style.display = "";

        }

        // show taskname dung voi tung projectname trong modal add
        $(document).ready(function(){

            $("#project").change(function(){
                var project_id = $(this).val();
                $.get("task/"+project_id, function(data){
                    $("#task").html(data);
                    // alert(data);
                });
            });
        });

        // show taskname dung voi tung projectname when edit timesheet
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

        // get id when click edit timesheet
        // $(document).ready(function() {
        //     $('.edit').click(function() {
            
        //         var id = $(this).prev().attr("value");
        //         // alert(id);
        //         $.get("timesheet_edit/"+id, function(data){
        //             alert(data);
        //             // a.text(data);
        //             $("#project_edit").html(data);
        //         });
        //     });
        // });

        // ---------------- edit timeshet ----------------
        $('body').delegate('#edit','click',function(e){

          
          
          var id = $(this).data('id');
          $.get("{{ URL::to('timesheet/edit')}}",{id:id},function(data){

            $('#popup-update').find('#project_edit').val(data.project_id);
            $('#popup-update').find('#task_edit').val(data.task_id);
            $('#popup-update').find('#working_time_edit').val(data.working_time);
            $('#popup-update').find('#note_edit').val(data.note);
            $('#popup-update').find('#date_time_entries').val(data.date_time_entries);
            $('#popup-update').find('#overtime').val(data.overtime);
            $('#popup-update').find('#id').val(data.id);

            // show taskname dung voi tung project in modal when edit - lan dau tien load len
            var project_id = data.project_id;
            $.get("task_edit/"+project_id, function(data){
                $("#task_edit").html(data);
            });
            
            $('#popup-update').modal('show');
          })

        })

         // show taskname dung voi tung project in modal add lan dau tien load len
        $('body').delegate('#add','click',function(e){
          var project_id = $('select[name=project_id]').val();
          $.get("task/"+project_id, function(data){
              $("#task").html(data);
          });
        })


        // -------------- update timesheet -----------------
        $('#frm-update').on('submit',function(e){
          e.preventDefault();
          var data = $(this).serialize();
          var url = $(this).attr('action');
          $.post(url,data,function(data){
            console.log(data)
          })
        })

    </script>
@endsection