@extends('layouts.adminLayout.admin_design')
@section('title','Add Advisor')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/add-advisor') }}" class="current">Add Advisor</a> <a href="{{ url('/admin/view-advisors')}}">View Advisor</a>  </div>
    <h1>Advisors</h1>
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
            <h5>Add Advisor Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-advisor') }}" name="add_advisor" id="add_advisor" novalidate="novalidate">
              <div class="control-group"> {{ csrf_field() }}
                <label class="control-label">Advisor Name</label>
                <div class="controls">
                  <input type="text" name="advisor_name" id="advisor_name" placeholder="Full Name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Specialty</label>
                <div class="controls">
                  <input type="text" name="specialty" id="specialty" placeholder="Advisor Specialization">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone Number</label>
                <div class="controls">
                  <input type="text" name="phone_number" id="phone_number" placeholder="e.g 265888888888">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Location</label>
                <div class="controls">
                  <input type="text" name="advisor_location" id="advisor_location" placeholder="Current Residence">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Service Day(s) Seperate By - If More </label>
                <div class="controls">
                  <input type="text" name="days" id="days" placeholder="Service Days">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Start Time</label>
                <div class="controls">
                  <input type="text" name="start_time" id="start_time" placeholder="Time of Service">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">End Time</label>
                <div class="controls">
                  <input type="text" name="end_time" id="end_time" placeholder="Time of Service">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" style="margin-top: -5px;">&nbsp;Available &nbsp;&nbsp;
                  <input type="checkbox" name="status" id="status" value="2" required="">&nbsp;Not Available
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Advisor" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection