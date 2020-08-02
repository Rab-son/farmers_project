<?php 
// Get the current URL without the query string...
 $url = url()->current();
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <!--Admin Panel Dashboard-->
    <li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>>
      <a title="Go to Dashboard" href="{{ url('/admin/dashboard') }}"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a> </li>
    <!--User Management Section-->
    @if(Session::get('adminDetails')['farmers_access']==1)
    <li class="submenu"> <a title="Add or View" class="tip-bottom" href="#"><i class="icon icon-group"></i> <span>Farmers</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/farme/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-farmer/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/add-farmer') }}"><i class="icon icon-user"></i> Add Farmer </a></li>
        <li <?php if(preg_match("/view-farmers/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{ url('/admin/view-farmers') }}"><i class="icon icon-edit"></i> View Farmer</a></li>
      </ul>
    </li>
    @endif
    <!--Market Management Section-->
    @if(Session::get('adminDetails')['markets_access']==1)
    <li class="submenu"> <a title="Add or View" class="tip-bottom" href="#"><i class="icon icon-shopping-cart"></i> <span>Markets</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/marke/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-market/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/add-market') }}"><i class="icon icon-plus-sign"></i> Add Market</a></li>
        <li <?php if(preg_match("/view-markets/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/view-markets') }}"><i class="icon icon-eye-open"></i> View Market</a></li>
      </ul>
    </li>
    @endif
    <!--Advisor Management Section-->
    @if(Session::get('adminDetails')['advisors_access']==1)
    <li class="submenu"> <a title="Add or View" class="tip-bottom" href="#"><i class="icon icon-qrcode"></i> <span>Advisors</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/advis/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-advisor/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/add-advisor') }}"><i class="icon icon-plus"></i> Add Advisor</a></li>
        <li <?php if(preg_match("/view-advisors/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/view-advisors') }}"><i class="icon icon-list-alt"></i> View Advisor</a></li>
      </ul>
    </li>
    @endif
    <!--Supplier Management Section-->
    @if(Session::get('adminDetails')['suppliers_access']==1)
    <li class="submenu"> <a title="Add or View" class="tip-bottom" href="#"><i class="icon icon-briefcase" ></i> <span>Suppliers</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/supplie/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/add-supplier/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/add-supplier') }}"><i class="icon icon-user" ></i> Add Supplier </a></li>
        <li <?php if(preg_match("/view-suppliers/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{ url('/admin/view-suppliers') }}"><i class="icon icon-book" ></i> View Supplier </a></li>
      </ul>
    </li>
    @endif
    <!--SMS Portal Section-->
    @if(Session::get('adminDetails')['ussd_notifications_access']==1)
    <li class="submenu"> <a title="Send or Check" class="tip-bottom" href="#"><i class="icon  icon-envelope" ></i> <span> SMS Portal</span> <span class="label label-important">4</span></a>
      <ul <?php if(preg_match("/notifica/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/send-notification/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/send-notification') }}"><i class="icon icon-folder-open" ></i> Send Notification </a></li>
        <li <?php if(preg_match("/view-notifications/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/view-notifications') }}"><i class="icon icon-inbox" ></i> Sent Notifications  </a></li>
        <li><a href="#"><i class="icon icon-inbox" ></i> Received Notifications </a></li>
        <li <?php if(preg_match("/show-phonenumber/i", $url)){ ?> class="active" <?php } ?>>
          <a href="{{ url('/admin/show-phonenumber') }}"><i class="icon icon-inbox" ></i> Send SMS </a></li>
      </ul>
    </li>
    <!--SMS Order Section-->
    <li class="submenu"> <a href="#"><i class="icon icon-envelope-alt" ></i> <span> SMS Order</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="#"><i class="icon icon-shopping-cart" ></i> Order Tracking </a></li>
      </ul>
    </li>
    @endif
    <!--Adminstrator Section-->
    @if(Session::get('adminDetails')['type']=="Admin")
    <li class="submenu"> <a title="View Admins" class="tip-bottom" href="#"><i class="icon icon-key" ></i> <span>Adminstrators</span> <span class="label label-important">1</span></a>
      <ul <?php if(preg_match("/admins/i", $url)){ ?> style="display:block;" <?php } ?>>
        <li <?php if(preg_match("/view-admins/i", $url)){ ?> class="active" <?php } ?>>
        <a href="{{ url('/admin/view-admins') }}"><i class="icon icon-user" ></i> View Admins </a></li>
      </ul>
    </li>
    @endif
  </ul>
    
</div>
<!--sidebar-menu-->