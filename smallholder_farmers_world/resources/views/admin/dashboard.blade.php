@extends('layouts.adminLayout.admin_design') 
@section('content')

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a></div>
  </div>
  <!-- Displaying an error message when the user has provided wrong credintials -->  
  @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{!! session('flash_message_error') !!}</strong>
    </div>
  @endif         
  @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{!! session('flash_message_success') !!}</strong>
      </div>
  @endif
  
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
      @if(Session::get('adminDetails')['farmers_access']==1)
        <li class="bg_ls span3"> <a href="{{ url('/admin/view-farmers') }}"> <i class="icon-group"></i> <span class="label label-important">{{$farmerCount->total()}}</span> View Farmer </a> </li>
      @endif
      @if(Session::get('adminDetails')['markets_access']==1)
        <li class="bg_lg span3"> <a href="{{ url('/admin/view-markets') }}"> <i class="icon-shopping-cart"></i> <span class="label label-important">{{$marketCount->total()}}</span>View Markets</a> </li>
      @endif
   
      @if(Session::get('adminDetails')['markets_access']==1)
        <li class="bg_lb"> <a href="{{ url('/admin/view-markets') }}"> <i class="icon-envelope"></i><span class="label label-important"> {{$ussdNotificationCount->total()}} </span> Sent Notifications</a> </li>
      @endif
      
   
      @if(Session::get('adminDetails')['suppliers_access']==1) 
        <li class="bg_lo"> <a href="{{ url('/admin/view-suppliers') }}"> <i class="icon-truck"></i> <span class="label label-important">{{$supplierCount->total()}}</span> View Suppliers </a> </li>
      @endif
      

      @if(Session::get('adminDetails')['advisors_access']==1)
        <li class="bg_lv span3"> <a href="{{ url('/admin/view-advisors') }}"> <i class="icon-user"></i> <span class="label label-important">{{$advisorCount->total()}}</span> View Advisors</a> </li>
      @endif
      


      @if(Session::get('adminDetails')['farmers_access']==1)
        <li class="bg_lb span3"> <a href="{{ url('/admin/alert') }}"> <i class="icon-bell"></i> <span class="label label-important">{{$count->total()}} {{$count1->total()}}</span> New Notifications</a> </li>
      @endif
      @if(Session::get('adminDetails')['ussd_notifications_access']==1)
        <li class="bg_lg"> <a href="{{ url('/admin/view-notifications') }}"> <i class="icon icon-inbox"></i><span class="label label-important">{{$message->total()}}</span> Check Messages</a></li>
      @endif
      <li class="bg_lr"> <a href="{{ url('/admin/view-report-farmer') }}"> <i class="icon-bar-chart"></i><span class="label label-important">{{$farmerCount->total()}}</span> Statistics</a> </li>

      </ul>
    </div>

<!--End-Action boxes-->    


<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
          <h5>Small Holder Farmers World Management</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <div class="container-fluid">
                <ul class="site-stats">
                @if(Session::get('adminDetails')['farmers_access']==1)
                  <li class="bg_lh"><a href="{{ url('/admin/add-farmer') }}"><i class="icon-group" style="color: white;"></i> <strong>{{$farmerCount->total()}}</strong> <small><p style="color: white;">Add Farmer</p></small></a></li>
                @endif
                @if(Session::get('adminDetails')['advisors_access']==1)
                  <li class="bg_lh"><a href="{{ url('/admin/add-advisor') }}"><i class="icon-user" style="color: white;"></i> <strong>{{$advisorCount->total()}}</strong> <small><p style="color: white;">Add Advisor</p></small></a></li>
                @endif
                @if(Session::get('adminDetails')['markets_access']==1)
                  <li class="bg_lh"><a href="{{ url('/admin/add-market') }}"><i class="icon-shopping-cart" style="color: white;"></i> <strong>{{$marketCount->total()}}</strong> <small><p style="color: white;">Add Market</p></small></a></li>
                @endif
                @if(Session::get('adminDetails')['suppliers_access']==1)
                  <li class="bg_lh"><a href="{{ url('/admin/add-supplier') }}"><i class="icon-truck" style="color: white;"></i> <strong>{{$supplierCount->total()}}</strong> <small><p style="color: white;">Add Supplier</p></small></a></li>
                @endif
                  <li class="bg_lh"><a href="{{ url('/admin/add-show-phonenumber') }}"><i class="icon-envelope" style="color: white;"></i> <strong>10</strong> <small><p style="color: white;">Send Message</p></small></a></li>
                  <li class="bg_lh"><a href="{{ url('/admin/view-calculations') }}"><i class="icon-truck" style="color: white;"></i> <strong>Maize</strong> <small><p style="color: white;">Perform Calculations</p></small></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
  </div>
</div>

<!--end-main-container-part-->

@endsection


