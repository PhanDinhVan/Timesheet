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
    <script>
        // thieu thang nay khong delete timesheet duoc
        $(document).ready(function(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
        });

         // show taskname dung voi tung project in modal add lan dau tien load len
        $('body').delegate('#add','click',function(e){
          var project_id = $('select[name=project_id]').val();
          $.get("task/"+project_id, function(data){
              $("#task").html(data);
          });
        })

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
                    type : 'post',
                    url : "{{url('deleteByAjax')}}",
                    data : {id:id},
                    dataType : 'json',
                    success:function(data){
                         // alert(data);
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
                    //load lai page timesheet
                    // init_reload();
                    // function init_reload(){
                    //     setInterval( function() {
                    //                window.location.reload();
                 
                    //     },500);
                    // }
                    // console.log(data);
                    var frmupdate = $('#frm-update');
                    frmupdate.find('#project_id').val(data.project_id);
                    frmupdate.find('#task_id').val(data.task_id);
                    frmupdate.find('#working_time').val(data.working_time);
                    frmupdate.find('#overtime').val(data.overtime);
                    frmupdate.find('#date_time_entries').val(data.date_time_entries);
                    frmupdate.find('#note').val(data.note);
                    frmupdate.find('#id').val(data.id);

                    $('#popup-update').modal('show');
                }
            })
        })


        $('#frm-update').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            $.post(url,data,function(data){
                console.log(data)
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
                  $('.table-responsive').html(data);
                }
            })
        }

    </script>
@endsection