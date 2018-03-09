<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Amagumo Lab's</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="../admin_asset/page_login/assets/images/favicon2.ico">

        <!-- App css -->
        <link href="../admin_asset/page_login/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../admin_asset/page_login/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../admin_asset/page_login/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="../admin_asset/page_login/assets/js/modernizr.min.js"></script>
        <style type="text/css">
            body {
                background: #f5f5f5;
            }
            footer {
                /*background: #333333;*/
                padding: 10px 30px !important;
                color: black !important;
            }
            
        </style>

    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        @if(Auth::check()) 
                            @if(Auth::user()->position == 1)
                                <a href="{{url('admin/user/list')}}" class="logo">
                                    <span class="logo-small"><i class="mdi mdi-account-circle"></i></span>
                                    <span class="logo-large"><i class="mdi mdi-account-circle"></i> admin</span>
                                </a>
                            @endif
                        @endif
                        
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-inline float-right mb-0">

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="../admin_asset/page_login/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow">
                                            <small class="text-white">
                                                Welcome!    @if(Auth::check()) {{Auth::user()->lastname}} @endif
                                            </small> 
                                        </h5>
                                    </div>

                                    @if(Auth::check())
                                        <!-- item-->
                                        <a href="{{url('user/setting')}}" class="dropdown-item notify-item">
                                            <i class="mdi mdi-settings"></i> <span>Settings</span>
                                        </a>

                                        <!-- item-->
                                        <a href="{{url('logout')}}" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout"></i> <span>Logout</span>
                                        </a>
                                    @else
                                        return redirect('login'); 
                                    @endif

                                    
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg">
                        <!-- Modal trong laravel -->
                        @include('user.list_timesheet')
                        @include('user.add_timesheet')
                        @include('user.edit_timesheet')

                    </div>
                    <input type="hidden" id="user_login" value="{{Auth::user()->id}}">
                </div>
                <!-- end row -->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        @include('error.messages')


        <!-- Footer -->
        <div class="footer">
            <p>Amagumo Labs &copy;  <?php echo date('Y'); ?> - All rights reserved</p>
        </div>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="../admin_asset/page_login/assets/js/jquery.min.js"></script>
        <script src="../admin_asset/page_login/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="../admin_asset/page_login/assets/js/bootstrap.min.js"></script>
        <script src="../admin_asset/page_login/assets/js/waves.js"></script>
        <script src="../admin_asset/page_login/assets/js/jquery.slimscroll.js"></script>
        <script src="../admin_asset/page_login/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="../admin_asset/page_login/assets/js/jquery.core.js"></script>
        <script src="../admin_asset/page_login/assets/js/jquery.app.js"></script>
        <script src="../js/jquery/jquery-ui.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    
        // show taskname dung voi tung project in modal add lan dau tien load len
        $('body').delegate('#add','click',function(e){

            // show projectname dung voi tung username in modal add lan dau tien load len
            var user_id = $("#user_login").val();
            $.get("<?=Request::root()?>/project_user/"+user_id, function(data){
                $("#project").html(data);
                // select task name dung voi project name in modal add lan dau tien load len
                if(data != '') {
                    //var project_id = $(this).val();
                    var project_id = $('#project option:nth-child(1)').attr("value");
                    $.get("<?=Request::root()?>/task/"+project_id, function(data){
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
                $.get("<?=Request::root()?>/task/"+project_id, function(data){
                    $("#task").html(data);
                    // alert(data);
                });
            });

            // ========== show project name when username in modal add change ============
            $("#user_id").change(function(){
                var user_id = $(this).val();
                $.get("<?=Request::root()?>/project_user/"+user_id, function(data){
                    $("#project").html(data);
                    // alert(data);
                    // select task name dung voi project name in modal add when username change
                    if(data != '') {
                        //var project_id = $(this).val();
                        var project_id = $('#project option:nth-child(1)').attr("value");
                        $.get("<?=Request::root()?>/task/"+project_id, function(data){
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
                $.get("<?=Request::root()?>/task_edit/"+project_id, function(data){
                    $("#task_id").html(data);
                    // alert(data);
                });
            });

            // ========== show project name when username in modal edit change ============
            $("#user_id_edit").change(function(){
                var user_id = $(this).val();
                $.get("<?=Request::root()?>/project_user/"+user_id, function(data){
                    $("#project_id").html(data);
                    // alert(data);
                    // select task name dung voi project name in modal edit when username change
                    if(data != '') {
                        //var project_id = $(this).val();
                        var project_id = $('#project_id option:nth-child(1)').attr("value");
                        $.get("<?=Request::root()?>/task/"+project_id, function(data){
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
        $(document).on('click','.remove-row',function(e){
            // var result = confirm("Do you want to delete?");
            // $('#delete_timesheet').modal('show');

            // if (result) {
                var id = $('#id_delete').val();
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
                        // console.log(data);
                        $('.card-box .table tbody tr.id'+id).remove();
                        //load lai page timesheet
                        // init_reload();
                        // function init_reload(){
                        //     setInterval( function() {
                        //         window.location.reload();
                        //     },500);
                        // }
                    }
                })
            // }
        })

        //=============== update timesheet ==================
        $(document).on('click','.edit-row',function(e){
            // get vaulue the a
            var id = $(this).attr('href');
            // alert(id);
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

                    // setting date_time_entries
                    var date = new Date(data.date_time_entries);
                    var date_time_entries = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                    
                    //hien thi gia tri cua row can edit tren modal edit
                    var frmupdate = $('#frm-update');
                    frmupdate.find('#project_id').val(data.project_id);
                    frmupdate.find('#task_id').val(data.task_id);
                    frmupdate.find('#working_time_users_edit').val(working_time);
                    frmupdate.find('#working_time_admin_edit').val(working_time);
                    frmupdate.find('#overtime_users_edit').val(overtime);
                    frmupdate.find('#overtime_admin_edit').val(overtime);
                    frmupdate.find('#date_time_entries').val(date_time_entries);
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
                    $.get("<?=Request::root()?>/project_user/"+user_id, function(data){
                        // ========== show cac project tuong ung voi username ============
                        $("#project_id").html(data);
                        // ========== select dung project dang edit =============
                        var frmupdate = $('#frm-update');
                        frmupdate.find('#project_id').val(project_id_edit);
                        
                        // select task name dung voi project name in modal edit lan dau tien load len
                        if(data != '') {
                            // var project_id = $('#project_id option:nth-child(1)').attr("value");
                            var project_id = project_id_edit;
                            $.get("<?=Request::root()?>/task/"+project_id, function(data){
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
                    // $('.table-responsive').html(data);
                    $('.list_timesheet').html(data);
                  
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
                    // $('.table-responsive').html(data);
                    $('.list_timesheet').html(data);
                  
                }
            })
        }

    </script>

    </body>
</html>