
<li class="list-inline-item dropdown notification-list">
    <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        <img src="admin_asset/page_login/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
    </a>
    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="text-overflow"><small class="text-white">Welcome! {{Auth::user()->lastname}}</small> </h5>
        </div>

        @if(Auth::check())
            <!-- item-->
            <a href="admin/user/edit/{{Auth::user()->id}}" class="dropdown-item notify-item">
                <i class="mdi mdi-settings"></i> <span>Settings</span>
            </a>

            <!-- item-->
            <a href="admin/logout" class="dropdown-item notify-item">
                <i class="mdi mdi-logout"></i> <span>Logout</span>
            </a>
        @else
            return redirect('admin/login'); 
        @endif
        
    </div>
</li>