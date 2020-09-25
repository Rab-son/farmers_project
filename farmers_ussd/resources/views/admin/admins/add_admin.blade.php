@extends('layouts.adminLayout.admin_design')
@section('title','Add Adminstrator')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/add-admin') }}" title="Go to Add Adminstrator Section" class="current">Add Adminstrator</a> <a href="{{ url('/admin/view-admins')}}" title="Go to View Adminstrator Section" class="tip-bottom">View Adminstrator</a>  </div>
    <h1>Adminstrators</h1>
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
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-user"></i></span>
            <h5>Add Adminstrator Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-admin') }}" name="add_admin" id="add_admin" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group"> 
                <label class="control-label">Type</label>
                <div class="controls">
                  <select name="type" id="type" style="width : 220px;">
                    <option value="Admin">Admin</option>
                    <option value="Sub Admin">Sub Admin</option>
                  </select>
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">Username</label>
                <div class="controls">
                  <input type="text" name="username" id="username" placeholder="As email" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="password" id="password" placeholder="Enter Password" required="">
                </div>
              </div>
              <div class="control-group" id="access">
                <label class="control-label">Acess</label>
                <div class="controls">
                  <input type="checkbox" name="farmers_access" id="farmers_access" value="1" style="margin-top: -5px">
                  &nbsp;Farmers &nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="markets_access" id="farmers_access" value="1" style="margin-top: -5px">
                  &nbsp;Markets&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="suppliers_access" id="farmers_access" value="1" style="margin-top: -5px">
                  &nbsp;Suppliers&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="advisors_access" id="farmers_access" value="1" style="margin-top: -5px">
                  &nbsp;Advisors&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="ussd_notifications_access" id="farmers_access" value="1" style="margin-top: -5px">
                  &nbsp;USSD Notifications
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add As Adminstrator" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection