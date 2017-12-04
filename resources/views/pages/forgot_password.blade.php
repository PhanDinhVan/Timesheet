@extends('layout.index')

@section('content')

<style type="text/css">
    #thongbao{
        display: none;
    }
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
            	<div class="panel-heading">Forgot password</div>
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
                    
            		<form action="sendMail" method="POST">
			    		<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
			    			<label>E-Mail Address</label>
						  	<input type="email" class="form-control" placeholder="E-Mail" name="email" 
						  	>
						</div>
						<br>
						<button type="submit" class="btn btn-primary">Send email <i class="fa fa-paper-plane" aria-hidden="true"></i>
						</button>
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
    var username = document.getElementById('thongbao');
    if(username != null) {
        //err = document.getElementById('error').innerText;
        var tb = $('#thongbao').text();
        //cut space
        tb = tb.replace(/\s+/g, '');
        if(tb == 'username_null') {
            $('#username_null').modal('show');
        }
        else if(tb == 'not_found_email'){
            $('#not_found_email').modal('show');
        }
        else if(tb == 'expired'){
            $('#mail_expired').modal('show');
        }
        else if(tb == 'no_internet'){
            $('#no_internet').modal('show');
        }
    }

    var error = document.getElementById('error');
    if(error != null) {
        //err = document.getElementById('error').innerText;
        var err = $('#error').text();
        //cut space
        err = err.replace(/\s+/g, '');
        if(err == 'send_mail_null') {
            $('#send_mail_null').modal('show');
        }
    }
</script>
@endsection