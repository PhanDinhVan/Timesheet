<head>
    <base href="{{asset('')}}">
    <link href="admin_asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="admin_asset/build/css/custom.min.css" rel="stylesheet">
</head>

<div class="top_nav" style="margin-top: -5.5%;">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        @if(Auth::check()) 
          @if(Auth::user()->position == 1)
            <a id="menu_toggle" href="admin/user/list"><i class="fa fa-bars"></i></a>
          @endif
        @endif
        <!-- <button class="btn btn-info">Admin</button> -->
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt="">@if(Auth::check()) {{Auth::user()->lastname}} @endif
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            @if(Auth::check())
            <li><a href="user/setting"><i class="fa fa-cog pull-right"></i> Settings </a></li>
            <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out </a></li>
            @else
                return redirect('login'); 
            @endif
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>