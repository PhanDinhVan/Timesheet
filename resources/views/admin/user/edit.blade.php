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
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
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
                        <form action="admin/user/edit/{{$user->id}}" method="POST" id="edit_user">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group start_date_fr">
                                <label>First Name</label>
                                <input class="form-control" name="firstname" value="{{$user->firstname}}" placeholder="Please enter your name" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Last Name</label>
                                <input class="form-control" name="lastname" value="{{$user->lastname}}" placeholder="Please enter your name" />
                            </div>
                            <div class="form-group start_date_fr">
                                <label>Username</label>
                                <input class="form-control" type="email" name="email" value="{{$user->username}}" placeholder="Please enter your email" readonly="" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Employee Type</label>
                                <select class="form-control" name="employee_type_id">
                                    @foreach($employee_types as $value)
                                    <option 
                                        @if($user->employee_type_id == $value->id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group start_date_fr">
                                <label>Start Date</label>
   								<input class="date form-control" type="text" name="start_date" value="{{$user->start_date}}">
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
   								<input class="enddate form-control" type="text" name="end_date" value="{{$user->end_date}}">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
							    $('.enddate').datepicker({  
							       format: 'yyyy-mm-dd',
                                   autoclose: true
							     });  
							</script>

							
                            <div class="form-group start_date_fr">
                            	<input type="checkbox" name="changePassword" id="changePassword">
                                <label>Change Password</label>
                                <input class="form-control password" type="password" name="password" id="password" placeholder="Please enter your password" disabled="" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Password Again</label>
                                <input class="form-control password" type="password" name="passwordAgain" placeholder="Please enter your password" disabled="" />
                            </div>
                            <div class="form-group" style="width: 45%;">
                                <label>Position</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio"
                                    	@if($user->position == 1)
                                            {{"checked"}}
                                        @endif
                                    >Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio"
                                    	@if($user->position == 0)
                                            {{"checked"}}
                                        @endif
                                    >User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
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
       
<!-- /#page-wrapper -->	

@endsection

@section('script')
    <script src="{{asset('js/error/error.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
 @endsection
