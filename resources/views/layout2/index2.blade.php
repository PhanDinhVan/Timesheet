<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Amagumo Lab's | </title>
    <!-- thieu thang nay la no khong an css voi js day nhe -->
    <base href="{{asset('')}}">

    <!-- Bootstrap -->
    <link href="admin_asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="admin_asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="admin_asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="admin_asset/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="admin_asset/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="admin_asset/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="admin_asset/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="admin_asset/build/css/custom.min.css" rel="stylesheet">
    
    <!-- css file error in fordel admin -->
    <link rel="stylesheet" type="text/css"  href="css/mystyle.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Amagumo Lab's</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="admin_asset/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->lastname}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('layout2.menu2')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('layout2.menufooter2')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
            @include('layout2.header2')
        <!-- /top navigation -->

        <!-- page content -->
            @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <!-- <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="admin_asset/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="admin_asset/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="admin_asset/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="admin_asset/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="admin_asset/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="admin_asset/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="admin_asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="admin_asset/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="admin_asset/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="admin_asset/vendors/Flot/jquery.flot.js"></script>
    <script src="admin_asset/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="admin_asset/vendors/Flot/jquery.flot.time.js"></script>
    <script src="admin_asset/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="admin_asset/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="admin_asset/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="admin_asset/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="admin_asset/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="admin_asset/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="admin_asset/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="admin_asset/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="admin_asset/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="admin_asset/vendors/moment/min/moment.min.js"></script>
    <script src="admin_asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="admin_asset/build/js/custom.min.js"></script>

    <script type="text/javascript" src="admin_asset/vendors/jquery/jquery-validate/jquery.validate.min.js"></script>

    @yield('script')
    
  </body>
</html>
