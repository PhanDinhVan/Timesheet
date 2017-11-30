@extends('layout.index')

@section('content')

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
<!-- end Page Content -->
@endsection