@extends('layouts.adminLayout.admin_design')
@section('title','View Notification')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/send-notification') }}">Send Notification</a> <a href="{{ url('/admin/view-notifications') }}" class="current">Sent Notification</a></div>
    <h1>Notifications</h1>
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
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-envelope"></i></span>
            <h5>View Sent Notifications</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Phone Number</th>
                  <th>Farmer Name</th>
                  <th>Message</th>
                  <th>Sender Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($notifications as $notification) 
                <?php $i++; ?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i}}  </td>
                  <td style="text-align: center; text-transform: capitalize">0{{ $notification->phonenumber }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $notification->full_name}}</td>
                  <td style="text-align: center; text-transform: uppercase"> {{ $notification->sent_message }}</td>
                  <td style="text-align: center; text-transform: uppercase"> {{ $notification->sender_name }}</td>
                  <td style="text-align: center"> 
                      <a href="#myModal{{ $notification->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a href="{{ url('/admin/edit-notification/'.$notification->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a href="#myModal2{{ $notification->id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr> 
                  <div id="myModal{{ $notification->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style="text-align: center; text-transform: uppercase; color: black">{{ $notification->sender_name}} Full Details</h3>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center; text-transform: capitalize" >ID Number    : {{ $notification->farmer_id }} </p>
                      <p style="text-align: center; text-transform: capitalize">Location     : {{ $notification->sent_message }} </p>
                    </div>
                  </div>
                  <div id="myModal2{{ $notification->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style = "text-align: center"> You Want To Delete {{ $notification->sender_name }} Details ?</h3>
                    </div>
                    <div class="modal-body">
                        <h6 style ="text-align: center; color: red">Once You Delete The Details You Will Not Be Able To Recover It</h6>
                    </div>
                    <div class="modal-footer"> 
                      <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a> 
                      <a href="{{ url('/admin/delete-notification/'.$notification->id) }}" id="add-event-submit" class="btn btn-danger">Proceed To Delete</a> 
                    </div>
                  </div>                   
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection