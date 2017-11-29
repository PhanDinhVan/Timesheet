@extends('layout.index')

@section('content')

<style type="text/css">
	.btn-primary{
		float: right;
	}
	a{
		color: white;
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
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
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
			    	<form action="changepass" method="POST">
			    		<input type="hidden" name="_token" value="{{csrf_token()}}">
			    		<div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" readonly="" />
                        </div>
						<div class="form-group">
                            <label>New password</label>
                            <input class="form-control password" type="password" name="password" placeholder="Please enter new password" />
                        </div>
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input class="form-control password" type="password" name="passwordAgain" placeholder="Please confirm your password" />
                        </div>
                        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> <a href="login">Cancel </a></button>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                        
			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->
@endsection