<!-- This code allows the admin to an update for the old password  -->
@extends('layouts.adminLayout.admin_design') 
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">Settings</a></div>
    <h1>SMS Portal Settings</h1>
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
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>SMS Management Panel</h5>
            </div>
            <div class="widget-content nopadding">
              <div class="card-header">Add Phone Number</div>
              <div class="card-body">
              <form method="POST">
                  @csrf
                <div class="form-group"><label>Enter Phone Number</label>
                <input type="tel" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                </div>
                    <button type="submit" class="btn btn-primary">Register User</button>  
              </form>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
                <div class="card-header">
                    Send SMS message
                </div>
                <div class="card-body">
                  <form method="POST" action="/custom">
                    @csrf
                    <div class="form-group"><label>Select users to notify</label>
                        <select name="users[]" multiple class="form-control">
                            @foreach ($users as $user)
                            <option>{{$user->phone_number}}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label>Notification Message</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


