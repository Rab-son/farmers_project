@extends('layouts.adminLayout.admin_design')
@section('title','Send Notification Page')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/send-notification') }}" class="current">Send Notification</a> <a href="{{ url('/admin/view-notifications') }}">Sent Notification</a>  </div>
    <h1>Notification</h1>
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
          <div class="widget-title"> <span class="icon"> <i class="icon-envelope"></i> </span>
            <h5>Send Notification</h5>
          </div>
          <div class="widget-content nopadding">
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/send-notification') }}" name="send_notification" id="send_product" novalidate="novalidate"> {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Farmer phonenumber</label>
                <div class="controls">
                  <select name="farmer_id" id="farmer_id" style="width: 415px;">
                    <?php echo $farmers_dropdown; ?>
                  <select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sender Name</label>
                <div class="controls">
                  <input type="text" name="sender_name" id="sender_name" style="width: 400px;">
                </div>
              </div>
              <div class="control-group">
                  <label for="sent_message" class="control-label">Notification</label>
                  <div class="controls">
                      <textarea class="textarea_editor span12" name="sent_message" id="sent_message" rows="6" placeholder="Start Typing Here To Send Notification" style="width: 580px;"></textarea>
                  </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Send Notification" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
