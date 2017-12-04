@extends('layout.index')

@section('content')

<style type="text/css">
	.btn-default{
		margin-bottom: 2%;
	}
	.forgot{
		font-style: oblique;
		text-decoration: underline;
		color: blue;
	}
	#error{
        display: none;
    }
    #thongbao{
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
			  	<div class="panel-heading">Login</div>
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
                        <div class="alert alert-danger" id="thongbao">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    @if(session('send'))
                        <div class="alert alert-success">
                            {{session('send')}}
                        </div>
                    @endif
			    	<form action="login" method="POST">
			    		<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
			    			<label>Username</label>
						  	<input type="email" class="form-control" placeholder="Username" name="email" 
						  	>
						</div>
						<br>	
						<div>
			    			<label>Password</label>
						  	<input type="password" class="form-control" placeholder="Password" name="password">
						</div>
						<br>
						<button type="submit" class="btn btn-default">Login <i class="fa fa-sign-in" aria-hidden="true"></i>
						</button>
						<br>
						<a href="sendMail" class="forgot">Forgot Your Password?</a>
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
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'email') {
                $('#enter_username').modal('show');
            }
            else{
                $('#enter_password').modal('show');
            }
        }

        var thongbao = document.getElementById('thongbao');
        if(thongbao != null) {
            //err = document.getElementById('error').innerText;
            var tb = $('#thongbao').text();
            //cut space
            tb = tb.replace(/\s+/g, '');
            if(tb == 'incorrect') {
                $('#incorrect').modal('show');
            }
        }
        
    </script>
@endsection