@extends('layouts.adminLayout.admin_design')
@section('title','Edit Adminstrator')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/add-admin') }}" title="Go to Add Adminstrator Section" class="current">Edit Adminstrator</a> <a href="{{ url('/admin/view-admins')}}" title="Go to View Adminstrator Section" class="tip-bottom">View Adminstrator</a>  </div>
    <h1>Adminstrators</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-user"></i></span>
            <h5>Edit Adminstrator Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-admin/'.$adminDetails->id) }}" name="add_admin" id="edit_admin" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group"> 
                <label class="control-label">Type</label>
                <div class="controls">
                  <input type="text" name="type" id="type" placeholder="As email" readonly="" value="{{ $adminDetails->type}}">
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">Username</label>
                <div class="controls">
                  <input type="text" name="username" id="username" placeholder="As email" readonly="" value="{{ $adminDetails->username}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="password" id="password" placeholder="Enter Password" required="">
                </div>
              </div>
              @if($adminDetails->type=="Sub Admin")
              <div class="control-group">
                <label class="control-label">Acess</label>
                <div class="controls">
                  <input type="checkbox" name="farmers_access" id="farmers_access" value="1" style="margin-top: -5px"
                  @if($adminDetails->farmers_access == "1") checked @endif>&nbsp;Farmers &nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="markets_access" id="markets_access" value="1" style="margin-top: -5px"
                  @if($adminDetails->markets_access == "1") checked @endif>&nbsp;Markets&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="suppliers_access" id="markets_access" value="1" style="margin-top: -5px"
                  @if($adminDetails->suppliers_access == "1") checked @endif>&nbsp;Suppliers&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="advisors_access" id="advisors_access" value="1" style="margin-top: -5px"
                  @if($adminDetails->advisors_access == "1") checked @endif>&nbsp;Advisors&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="ussd_notifications_access" id="ussd_notifications_access" value="1" style="margin-top: -5px"
                  @if($adminDetails->ussd_notifications_access == "1") checked @endif>&nbsp;USSD Notifications
                </div>
              </div>
              @endif
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($adminDetails->status == "1") checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Apply Changes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection