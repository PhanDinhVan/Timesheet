@extends('layout2.index2')
@section('content')
	
	<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Setting - 
                        <small>{{Auth::user()->lastname}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                     @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger" >
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
                               
                            @endforeach
                        </div>
                    @endif

                  	<form action="user/setting" method="POST" id="user_setting">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="firstname" value="{{$user->firstname}}" placeholder="Please enter your name" />
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="lastname" value="{{$user->lastname}}" placeholder="Please enter your name" />
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="email" name="email" value="{{$user->username}}" placeholder="Please enter your email" readonly="" />
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" name="changePassword" id="changePassword">
                            <label>Change Password</label>
                            <input class="form-control password" type="password" name="password" id="password" placeholder="Please enter your password" disabled="" />
                        </div>
                        <div class="form-group">
                            <label>Password Again</label>
                            <input class="form-control password" type="password" name="passwordAgain" placeholder="Please enter your password" disabled="" />
                        </div>
                        
                        <button type="submit" class="btn btn-default">Save</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <a class="btn btn-default btn-close" href="{{ URL::to('user/timesheet') }}">Cancel</a>
                    <form>
                </div>
                
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>

@endsection

@section('script')
   
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
    <script src="{{asset('js/error/error.js')}}"></script>

 @endsection