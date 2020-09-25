@extends('layouts.adminLayout.admin_design')
@section('title','View Admins')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-farmer') }}">Add Admin</a> <a href="{{ url('/admin/view-admins') }}" class="current">View Admin</a> </div>
    <h1>Chat Room</h1>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span12">
        <div class="widget-box widget-chat">
          <div class="widget-title"> <span class="icon"> <i class="icon-comment"></i> </span>
            <h5>Chat Area</h5>
          </div>
          <div class="widget-content nopadding">
            <div class="chat-content panel-left1">
                <div class="panel-body" id="chatPanel">
                </div>
              <div class="chat-message well">
                <button id="sendMessageBtn" class="btn btn-success" type="button">Send</button>
                <span class="input-box">
                <input type="text" name="msg-box" id="chatMessage" placeholder="Send a message here..." />
                </span> 
              </div>
          
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection