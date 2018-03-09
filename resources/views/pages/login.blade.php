<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Amagumo Labs @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="admin_asset/page_login/assets/images/favicon2.ico">

        <!-- App css -->
        <link href="admin_asset/page_login/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="admin_asset/page_login/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="admin_asset/page_login/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="admin_asset/page_login/assets/js/modernizr.min.js"></script>

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
    <body class="body_login">

        <div class="wrapper-page">
        	<div class="signin">
	            <div class="text-center">
	                <a href="http://amagumolabs.com/" class="logo-lg logo-sm">
	                	<img id="logo-bkg" src="admin_asset/page_login/assets/images/amagumo-logo-small-white.png" alt="home">
	                 </a>
	            </div>

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

	            <form class="form-horizontal m-t-20" action="login" method="POST">
	            	<input type="hidden" name="_token" value="{{csrf_token()}}">

	                <div class="form-group row">
	                    <div class="col-12">
	                        <div class="input-group">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
	                            </div>
	                            <input class="form-control" type="text" required="" placeholder="Username" name="email">
	                        </div>
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <div class="col-12">
	                        <div class="input-group">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text"><i class="mdi mdi-radar"></i></span>
	                            </div>
	                            <input class="form-control" type="password" required="" placeholder="Password" name="password">
	                        </div>
	                    </div>
	                </div>

	                <div class="form-group row">
	                    <div class="col-12">
	                        <div class="checkbox checkbox-primary">
	                            <input id="checkbox-signup" type="checkbox">
	                            <label for="checkbox-signup" class="color_white">
	                                Remember me
	                            </label>
	                        </div>

	                    </div>
	                </div>

	                <div class="form-group text-right m-t-20">
	                    <div class="col-xs-12">
	                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Log In
	                        </button>
	                    </div>
	                </div>

	                <div class="form-group row m-t-30">
	                    <div class="col-sm-7">
	                        <a href="sendMail" class="color_white"><i class="fa fa-lock m-r-5"></i> Forgot your
	                            password?</a>
	                    </div>
	                    <div class="col-sm-5 text-right">
	                        <a href="pages-register.html" class="color_white">Create an account</a>
	                    </div>
	                </div>
	            </form>
            </div>
        </div>

        <div class="footer_login">
		    <p>Amagumo Labs &copy;  <?php echo date('Y'); ?> - All rights reserved</p>
		</div>


        <!-- jQuery  -->
        <script src="admin_asset/page_login/assets/js/jquery.min.js"></script>
        <script src="admin_asset/page_login/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="admin_asset/page_login/assets/js/bootstrap.min.js"></script>
        <script src="admin_asset/page_login/assets/js/waves.js"></script>
        <script src="admin_asset/page_login/assets/js/jquery.slimscroll.js"></script>
        <script src="admin_asset/page_login/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="admin_asset/page_login/assets/js/jquery.core.js"></script>
        <script src="admin_asset/page_login/assets/js/jquery.app.js"></script>

        <!-- <script src="admin_asset/vendors/jquery/dist/jquery.min.js"></script>
		<script src="admin_asset/vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
		<script src="admin_asset/sweetalert/dist/sweetalert.min.js"></script>
		<script src="js/login/login.js"></script>

	</body>
</html>