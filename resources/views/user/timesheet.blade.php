<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

<!-- thieu thang nay khong delete timesheet duoc  -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layout.index')

@include('layout.header')


@section('content')
<!-- Page Content --> 
<div class="container">
    <div class="panel panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="x_content">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#yourModal" id="add">
                        <i class="fa fa-plus pull-left " style="margin-top: 5%;"></i>Add Time
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
            <input type="hidden" id="user_login" value="{{Auth::user()->id}}">
        </div>
        <!-- Modal trong laravel -->
        @include('user.add_timesheet')
        @include('user.list_timesheet')
        @include('user.edit_timesheet')
    </div>
</div>



<!-- /#page-wrapper -->	

@endsection

@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script src="js/jquery/jquery-ui.min.js"></script>
<script>
    
     // show taskname dung voi tung project in modal add lan dau tien load len
    $('body').delegate('#add','click',function(e){

      // show projectname dung voi tung username in modal add lan dau tien load len
      var user_id = $("#user_login").val();
      $.get("project_user/"+user_id, function(data){
            $("#project").html(data);
          // select task name dung voi project name in modal add lan dau tien load len
             if(data != '') {
                //var project_id = $(this).val();
                var project_id = $('#project option:nth-child(1)').attr("value");
                $.get("task/"+project_id, function(data){
                    $("#task").html(data);
                });
            }
      });

    })

    // ================ Modal Add =================
    $(document).ready(function(){

        // show taskname dung voi tung projectname in modal add
        $("#project").change(function(){
            var project_id = $(this).val();
            $.get("task/"+project_id, function(data){
                $("#task").html(data);
                // alert(data);
            });
        });

        // ========== show project name when username in modal add change ============
        $("#user_id").change(function(){
            var user_id = $(this).val();
            $.get("project_user/"+user_id, function(data){
                $("#project").html(data);
                // alert(data);
                // select task name dung voi project name in modal add when username change
                if(data != '') {
                    //var project_id = $(this).val();
                    var project_id = $('#project option:nth-child(1)').attr("value");
                    $.get("task/"+project_id, function(data){
                        $("#task").html(data);
                    });
                }
            });
        });
    });

    // ================ Modal Edit =================
    $(document).ready(function(){

        // show taskname dung voi tung projectname in modal edit
        $("#project_id").change(function(){
            var project_id = $(this).val();
            $.get("task_edit/"+project_id, function(data){
                $("#task_id").html(data);
                // alert(data);
            });
        });

        // ========== show project name when username in modal edit change ============
        $("#user_id_edit").change(function(){
            var user_id = $(this).val();
            $.get("project_user/"+user_id, function(data){
                $("#project_id").html(data);
                // alert(data);
                // select task name dung voi project name in modal edit when username change
                if(data != '') {
                    //var project_id = $(this).val();
                    var project_id = $('#project_id option:nth-child(1)').attr("value");
                    $.get("task/"+project_id, function(data){
                        $("#task_id").html(data);
                    });
                }
            });
        });
    });


    //================== add timesheet ================
    $('#frm-add').on('submit',function(e){
        e.preventDefault();
      
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        var data = $(this).serialize();
      
        $.ajax({
            type : post,
            url : url,
            data : data,
            success:function(data){
                // alert(data);
                //load lai page timesheet
                init_reload();
                function init_reload(){
                    setInterval( function() {
                               window.location.reload();
             
                    },500);
                }
            }
        })
    });

    //=============== delete timesheet ==================
    $(document).on('click','.btn-dell',function(e){
        var result = confirm("Do you want to delete?");
        if (result) {
            var id = $(this).val();
            $.ajax({
            	//thieu thang headers khong delete duoc timesheet
            	headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
                type : 'post',
                url : "{{url('deleteByAjax')}}",
                data : {id:id},
                dataType : 'json',
                success:function(data){
                    $('.table-responsive .table tbody tr.id'+id).remove();
                    //load lai page timesheet
                    init_reload();
                    function init_reload(){
                        setInterval( function() {
                                   window.location.reload();
                 
                        },500);
                    }
                }
            })
        }
    })

    //=============== update timesheet ==================
    $(document).on('click','.btn-edit',function(e){
        var id = $(this).val();
        $.ajax({
            type : 'get',
            url : "{{url('getEditAjax')}}",
            data : {id:id},
            success:function(data){
                //setting value working_time and overtime

                var total_minutes = (data.working_time);
                var hours = Math.floor(total_minutes/60);
                var minutes = total_minutes%60;

                var count = hours.toString().length;
                if(count < 2){
                    hours = '0'+hours;
                }
                var count_1 = minutes.toString().length;
                if(count_1 < 2){
                    minutes = '0'+minutes;
                }

                working_time = hours + ':' + minutes;

                //overtime
                var total_minutes2 = (data.overtime);
                var hours2 = Math.floor(total_minutes2/60);
                var minutes2 = total_minutes2%60;

                var count_2 = hours2.toString().length;
                if(count_2 < 2){
                    hours2 = '0'+hours2;
                }
                var count_3 = minutes2.toString().length;
                if(count_3 < 2){
                    minutes2 = '0'+minutes2;
                }

                overtime = hours2 + ':' + minutes2;
                
                //hien thi gia tri cua row can edit tren modal edit
                var frmupdate = $('#frm-update');
                frmupdate.find('#project_id').val(data.project_id);
                frmupdate.find('#task_id').val(data.task_id);
                frmupdate.find('#working_time_users_edit').val(working_time);
                frmupdate.find('#working_time_admin_edit').val(working_time);
                frmupdate.find('#overtime_users_edit').val(overtime);
                frmupdate.find('#overtime_admin_edit').val(overtime);
                frmupdate.find('#date_time_entries').val(data.date_time_entries);
                frmupdate.find('#note').val(data.note);
                frmupdate.find('#id').val(data.id);
                frmupdate.find('#user_id_edit').val(data.user_id);

                // ======show taskname dung voi tung project in modal edit when - lan dau tien load len ========
                // var project_id = data.project_id;
                // $.get("task_edit/"+project_id, function(data){
                //     $("#task_id").html(data);
                // });
                // var user_id = $("#user_id_edit").val();
                var project_id_edit = data.project_id;
                var task_id_edit = data.task_id;
                var user_id = data.user_id;
                $.get("project_user/"+user_id, function(data){
                    // ========== show cac project tuong ung voi username ============
                    $("#project_id").html(data);
                    // ========== select dung project dang edit =============
                    var frmupdate = $('#frm-update');
                    frmupdate.find('#project_id').val(project_id_edit);
                    
                    // select task name dung voi project name in modal edit lan dau tien load len
                    if(data != '') {
                        // var project_id = $('#project_id option:nth-child(1)').attr("value");
                        var project_id = project_id_edit;
                        $.get("task/"+project_id, function(data){
                            // ========== show cac task tuong ung voi project ============
                            $("#task_id").html(data);
                            // ========== select dung task dang edit =============
                            var frmupdate = $('#frm-update');
                            frmupdate.find('#task_id').val(task_id_edit);
                        });
                    }
                });

                // Cho nay dung show cua modal luon roi nha, ngay button edit file readByAjax
                // $('#popup-update').modal('show');
            }
        })
    })

    //update lai gia tri
    $('#frm-update').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        $.post(url,data,function(data){
            // console.log(data)
            $('#frm-update').trigger('reset');
            // load lai page
            init_reload();
            function init_reload(){
                setInterval( function() {
                           window.location.reload();
         
                  },500);
            }
        })
    })

    //==========================================
    readByAjax();
    //============================ Load page timesheet ====================
    function readByAjax(){
         $.ajax({
            type : 'get',
            url : "{{url('readByAjax')}}",
            dataType : 'html',
            success:function(data)
            {
              // console.log(data);
              // show table timesheet
                $('.table-responsive').html(data);
              
            //========== show task name when first load page timesheet =========== 
                // var temp = $('table tbody .taskname');
                // temp.each(function() {
                //     var a = $(this);
                //     var task_id = a.text();
                //     // alert(task_id);
                //     $.get("taskname/"+task_id, function(data){
                //         // alert(data);
                //         a.text(data);
                //     });
                // });

             //========== show project name when first load page timesheet ===========  
                // var temp = $('table tbody .projectname');
                // temp.each(function() {
                //     var a = $(this);
                //     var project_id = a.text();
                //     // alert(project_id);
                //     $.get("projectname/"+project_id, function(data){
                //         // alert(data);
                //         a.text(data);
                //     });
                
                // });

            }
        })
    }

    //================== Day of weaek =====================

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


    //================ When click change date ==================
    document.getElementById("datepicker").onchange = function() {myFunction()};
    function myFunction() {

        // dung de clear cac column add truoc do
        // $("#ajax_data").empty();
       
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
        document.getElementById("dayofweek").innerHTML = n;  

        // get data khi thay doi date
       $.ajax({
            type : 'get',
            url : "{{url('readByAjax_ChangeDay')}}",
            data : {create_date:create_date},
            dataType : 'html',
            success:function(data)
            {
              // console.log(data);
              // show table timesheet
                $('.table-responsive').html(data);
              
            }
        })
    }

    // $( function() {
        
    //     $( "#searchItem" ).autocomplete({
    //       source: 'http://localhost/Timesheet/public/search'
    //     });
    // });


    //==========================================
    // search();
    //============================ Load page timesheet ====================
    // function search(){
    //     var searchItem = document.getElementById('searchItem').value;
    //     alert(searchItem);
    //     // $.ajax({
    //     //     type : 'get',
    //     //     url : "{{url('search')}}",
    //     //     dataType : 'html',
    //     //     success:function(data)
    //     //     {
    //     //       // console.log(data);
    //     //       // show table timesheet
    //     //         $('.table-responsive').html(data);
    //     //     }
    //     // })
    // }

    // $(document).ready(function(){
    //     $('#searchItem').on('change',function(){
    //         var searchItem = document.getElementById('searchItem').value;
    //         alert(searchItem);
    //     });
    // });

    // document.getElementById("searchItem").onchange = function() {search()};
    // function search() {

    //     var searchItem = document.getElementById('searchItem').value;
    //     alert(searchItem);
    // }
</script>
@endsection