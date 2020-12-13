<!--Header-part-->
<div id="header">
  <h1><a href="{{ url('/admin/dashboard') }}">SFW Admin Panel</a></h1>
  <h2><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-laptop"></i></a></h2>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="javascript:void(0)">
      <span class="text">{{ Session::get('adminDetails')['username'] }} ({{ Session::get('adminDetails')['type'] }})
      </span></a>
    </li>
    <li  class="dropdown" id="profile-messages">
      <a title="Change Password or Add Admin and More..." class="tip-bottom" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-cog"></i> 
       <span class="text">Change Settings</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li class=""><a title="Change Password" href="{{ url('/admin/settings') }}"><i class="icon icon-key"></i> <span class="text">Update Password</span></a></li>
        <li class="divider"></li>
        @if(Session::get('adminDetails')['type']=="Admin")
        <li><a title="Register Adminstrator" href="{{ url('/admin/add-admin') }}"><i class="icon-check"></i> Add Admin</a></li>
        <li class="divider"></li>
        @endif
        <li class=""><a title="Logut of The System" href="{{ url('/logout') }}"><i class="icon-signout"></i> <span class="text">Logout</span></a></li>
        <li class="divider"></li>
        <li class=""><a title="Dashboard" href="{{ url('/admin/dashboard') }}"><i class="icon-dashboard"></i> <span class="text">Return To Dashboard</span></a></li>
      </ul>
    </li>
    <li class=""><a title="Logout of The System" class="tip-bottom" href="{{ url('/logout') }}"><i class="icon-signout"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
