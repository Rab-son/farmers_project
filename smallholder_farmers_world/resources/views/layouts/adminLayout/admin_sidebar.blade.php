<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <!--Admin Panel Dashboard-->
    <li class="active"><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a> </li>

    <!--User Management Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-group"></i> <span>Users</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-user"></i> Add User </a></li>
        <li><a href="{{ url('/admin/view-categories') }}"><i class="icon icon-edit"></i> View User</a></li>
      </ul>
    </li>
    <!--Market Management Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-shopping-cart"></i> <span>Markets</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="#"><i class="icon icon-plus-sign"></i> Add Market</a></li>
        <li><a href="#"><i class="icon icon-eye-open"></i> View Market</a></li>
      </ul>
    </li>
    <!--Advisor Management Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-qrcode"></i> <span>Advisors</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="#"><i class="icon icon-plus"></i> Add Advisor</a></li>
        <li><a href="#"><i class="icon icon-list-alt"></i> View Advisor</a></li>
      </ul>
    </li>
    <!--Farm Management Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-briefcase" ></i> <span> Farm Management</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="#"><i class="icon icon-user" ></i> Add Supplier </a></li>
        <li><a href="#"><i class="icon icon-book" ></i> View Supplier </a></li>

      </ul>
    </li>
    <!--Financial Management Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-money"></i> <span> Financial Management </span><span class="label label-important">1</span></a>
      <ul>
        <li><a href="#"><i class="icon icon-calculator"></i> Perform Calculations</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->