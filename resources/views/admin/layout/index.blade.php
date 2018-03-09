<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Amagumo Lab's</title>
        <base href="{{asset('')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="admin_asset/page_login/assets/images/favicon.ico">

        <link href="admin_asset/plugins/nvd3/build/nv.d3.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="admin_asset/page_login/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="admin_asset/page_login/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="admin_asset/page_login/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="admin_asset/page_login/assets/js/modernizr.min.js"></script>

        <link href="admin_asset/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <a href="admin/user/list" class="logo">
                            <span class="logo-small"><i class="mdi mdi-account-circle"></i></span>
                            <span class="logo-large"><i class="mdi mdi-account-circle"></i> admin</span>
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-inline float-right mb-0">

                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                            @include('admin.layout.header')

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            @include('admin.layout.menu')
            
        </header>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <!-- <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"></a></li>
                                    <li class="breadcrumb-item"><a href="#"></a></li>
                                    <li class="breadcrumb-item active"></li>
                                </ol> -->
                            </div>
                            <h4 class="page-title"> </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <!-- page content -->
                    @yield('content')
                <!-- /page content -->

                

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Amagumo Labs &copy;  <?php echo date('Y'); ?> - All rights reserved</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- jQuery  -->
        <script src="admin_asset/page_login/assets/js/jquery.min.js"></script>
        <script src="admin_asset/page_login/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="admin_asset/page_login/assets/js/bootstrap.min.js"></script>
        <script src="admin_asset/page_login/assets/js/waves.js"></script>
        <script src="admin_asset/page_login/assets/js/jquery.slimscroll.js"></script>
        <script src="admin_asset/page_login/assets/js/jquery.scrollTo.min.js"></script>

        <!-- Nvd3 js -->
        <script src="admin_asset/plugins/d3/d3.min.js"></script>
        <script src="admin_asset/plugins/nvd3/build/nv.d3.min.js"></script>
        <script src="admin_asset/page_login/assets/pages/jquery.nvd3.init.js"></script>

        <!-- App js -->
        <!-- <script src="admin_asset/page_login/assets/js/jquery.core.js"></script> -->
        <script src="admin_asset/page_login/assets/js/jquery.app.js"></script>

        <!-- Required datatable js -->
        <script src="admin_asset/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="admin_asset/plugins/datatables/dataTables.bootstrap4.min.js"></script>


        <!-- Responsive datatable JS -->
        <script src="admin_asset/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="admin_asset/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script src="js/datatable/datatables.js"></script>
        <script src="js/validate/total_validate.js"></script>

        <!-- gop row of column -->
        <script src="admin_asset/vendors/dataTables/js/dataTables.rowsGroup.js"></script>

        <!-- validate -->
        <script type="text/javascript" src="admin_asset/vendors/jquery/jquery-validate/jquery.validate.min.js"></script>

        <!-- multiselect of bootstrap 3 -->
        <!-- <script src="js/multiselect/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="css/multiselect/bootstrap-multiselect.css" /> -->

        <!-- multiselect of bootstrap 4 -->
        <script type="text/javascript" src="admin_asset/plugins/multiselect/js/jquery.multi-select.js"></script>
        <link href="admin_asset/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <!-- datepicker -->
        <!-- <link href="admin_asset/page_login/assets/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="admin_asset/page_login/assets/js/jquery.js"></script>
        <script src="admin_asset/page_login/assets/js/bootstrap-datepicker.js"></script> -->
        <script src="js/datetimepicker/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="css/datetimepicker/bootstrap-datepicker.css" />

        <script src="js/d3js/d3.js"></script>
        <script src="js/d3js/d3plus.js"></script>
        <script src="js/timesheet/timesheet.js"></script>
        

        @yield('script')

    </body>
</html>