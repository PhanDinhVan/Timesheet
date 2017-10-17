<!-- Navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt="">{{Auth::user()->lastname}}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            @if(Auth::check())
            <li><a href="admin/user/edit/{{Auth::user()->id}}"><i class="fa fa-cog pull-right"></i> Settings </a></li>
            <li><a href="admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out </a></li>
            @else
                return redirect('admin/login'); 
            @endif
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>