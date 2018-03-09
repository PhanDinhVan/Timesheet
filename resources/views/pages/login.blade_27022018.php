<!DOCTYPE html>
<html>
	<head>
		<title>Amagumo Labs @yield('title')</title>
		<!-- For-Mobile-Apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Lucid Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //For-Mobile-Apps -->
		<link rel="stylesheet" href="admin_asset/page_login/css/style.css" type="text/css" media="all" />
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
		    #success{
		        display: none;
		    }
		</style>
	</head>
	<body>
		<div class="container">
		<h1>AMAGUMO Labs</h1>
			<div class="signin">
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
			        <div class="alert alert-success" id="success">
			            {{session('send')}}
			        </div>
			    @endif
		     	<form action="login" method="POST">
		     		<input type="hidden" name="_token" value="{{csrf_token()}}">
			      	<input type="email" class="user" placeholder="username" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'username';}" />
			      	<input type="password" class="pass" placeholder="password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" />
			      	<!-- <label>
				  		<input type="checkbox" value="Remember-Me" /> Remember Me?
				  	</label> -->
		          	<input type="submit" value="LOGIN" />
		          	<br> <br>
					<a href="sendMail" class="forgot" style="color: white;">Forgot Your Password?</a>
			 	</form>
			</div>
		</div>
		<div class="footer">
		    <p>Amagumo Labs &copy;  <?php echo date('Y'); ?> - All rights reserved</p>
		</div>

		<script src="admin_asset/vendors/jquery/dist/jquery.min.js"></script>
		<script src="admin_asset/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="admin_asset/sweetalert/dist/sweetalert.min.js"></script>
		<script src="js/login/login.js"></script>
		
	</body>
</html>




	
