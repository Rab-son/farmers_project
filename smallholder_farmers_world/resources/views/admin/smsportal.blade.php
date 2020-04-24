<!-- This code allows the admin to an update for the old password  -->
@extends('layouts.adminLayout.admin_design') 
@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#" class="tip-bottom">Settings</a> <a href="#" class="current">SMS Portal Management</a> </div>
  <h1>SMS Portal Management</h1>
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
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-phone"></i> </span>
          <h5>Add Phone Number</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="POST" action="/admin/storePhoneNumber" class="form-horizontal" name="number_validate" id="number_validate" novalidate="novalidate">
            @csrf
            <div class="control-group">
              <label class="control-label">Enter Phone Number</label>
              <div class="controls">
                <input type="tel" name="phone_number" id="phone_number" class="span11" placeholder="Enter Phone Number" />
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Register User</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-envelope"></i> </span>
          <h5>Send SMS To Users</h5>
        </div>
        <form method="POST" action="/admin/custom" class="form-horizontal" name="text_validate" id="text_validate" novalidate="novalidate">
          @csrf
        <label class="control-label">Select Users To Notify </label>
        <div class="controls">
          <select multiple name="users[]" class="form-horizontal">
            @foreach ($users as $user)
            <option>{{$user->phone_number}}</option>
            @endforeach
          </select>
        </div>
        <br>
        <div class="widget-content nopadding">
          <label class="widget-title"><span class="icon"><i class="icon-envelope"></i> </span><h5>Notification Message</h5></label>
            <div class="control-group">
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="4" name="body" id="body" placeholder="Enter Text Here ..."></textarea>
                </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Send Notification</button>
              </div>
            </div>
        </div>
        </form>
      
      
      </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection


