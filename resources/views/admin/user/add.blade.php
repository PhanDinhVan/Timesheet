@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users
                        <small>Add new</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger" id="error">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success customer_fr">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/user/add" method="POST" id="add_user">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group start_date_fr">
                                <label>First Name</label>
                                <input class="form-control" name="firstname" placeholder="Please enter your name" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Last Name</label>
                                <input class="form-control" name="lastname" placeholder="Please enter your name" />
                            </div>
                            
                            <div class="form-group start_date_fr">
                                <label>Username</label>
                                <input class="form-control" type="email" name="email" placeholder="Please enter your email" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Employee Type</label>
                                <select class="form-control" name="employee_type_id">
                                    <option></option>
                                    @foreach($employee_types as $value)
                                    <option value="{{$value->id}}">{{$value->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group start_date_fr">
                                <label>Start Date</label>
   								<input class="date form-control" type="text" name="start_date">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
							    $('.date').datepicker({  
							       format: 'yyyy-mm-dd',
                                   autoclose: true
							     });  
							</script>

							<div class="form-group end_date_fr">
                                <label>End Date</label>
   								<input class="enddate form-control" type="text" name="end_date">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
							    $('.enddate').datepicker({  
							       format: 'yyyy-mm-dd',
                                   autoclose: true
							     });  
							</script>

							
                            <div class="form-group start_date_fr">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Please enter your password" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Password Again</label>
                                <input class="form-control" type="password" name="passwordAgain" placeholder="Please enter your password" />
                            </div>
                            <div class="form-group customer_fr">
                                <label>Position</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a class="btn btn-default btn-close" href="{{ URL::to('admin/user/list') }}">Cancel</a>
                        <form>
                </div>
               
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@include('error.messages')  
<!-- /#page-wrapper -->	

@endsection

@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'email_exits') {
                $('#user_exits').modal('show');
            }
        }
    </script>
    
@endsection




