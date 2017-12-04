@extends('layout.index')

@section('content')

<style type="text/css">
    #error{
        display: none;
    }
</style>

<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
			  	<div class="panel-heading">Reset Password</div>
			  	<div class="panel-body">
			  		@if(count($errors) > 0)
                        <div class="alert alert-danger" id="error">
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
                                @break
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-danger">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    @if(session('send'))
                        <div class="alert alert-success">
                            {{session('send')}}
                        </div>
                    @endif
			    	<form action="resetPass" method="POST">
			    		<input type="hidden" name="_token" value="{{csrf_token()}}">
			    		<div class="form-group">
                            <label>Username</label>
                            @foreach($username as $value)
                                <input class="form-control" type="text" name="username" value="{{ $value->email }}" readonly="" />
                            @endforeach
                        </div>
                        <input value="{{ $token }}" type="hidden" name="token"/>
						<div class="form-group">
                            <label>New password</label>
                            <input class="form-control password" type="password" name="password" placeholder="Please enter new password" />
                        </div>
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input class="form-control password" type="password" name="passwordAgain" placeholder="Please confirm your password" />
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                        
			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->
</div>
@include('error.messages')
<!-- end Page Content -->
@endsection

@section('script')
    <script type="text/javascript">
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'new_password') {
                $('#new_password').modal('show');
            }
            else if(err == 'password_min'){
                $('#password_min').modal('show');
            }
            else if(err == 'password_max'){
                $('#password_max').modal('show');
            }
            else if(err == 'confirm_password'){
                $('#confirm_password').modal('show');
            }
            else{
                $('#confirmation_password').modal('show');
            }
        }
    </script>
@endsection