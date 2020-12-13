@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#">Advisors </a> <a href="#" class="current">Edit Advisor Details</a> </div>
    <h1>Advisors </h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Advisor</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-advisor/'.$advisorDetails->id) }}"  name="edit_advisor" id="edit_advisor" novalidate="novalidate">
              <div class="control-group">{{ csrf_field() }}
                <label class="control-label">Advisor Name</label>
                <div class="controls">
                  <input type="text" name="advisor_name" id="advisor_name" placeholder="Full Name" value="{{ $advisorDetails->advisor_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Specialty</label>
                <div class="controls">
                  <input type="text" name="specialty" id="specialty" placeholder="Advisor Specialization" value="{{ $advisorDetails->specialty}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone Number</label>
                <div class="controls">
                  <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ $advisorDetails->phone_number}}">
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">District</label>
                <div class="controls">
                  <select style="width : 220px;" name="district_id" class="districtname" id="district_id">
                      <option value="0" disabled selected>District Name</option>
                      @foreach($district as $cat)
		                	  <option value="{{$cat->id}}">{{ucfirst($cat->districtname)}}</option>
		                  @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">EPA</label>
                <div class="controls">
                  <select style="width : 220px;" name="epaname" id="epaname">
                  <option value="0" disabled selected>EPA Name</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Service Day(s) Seperate By - If More</label>
                <div class="controls">
                  <input type="text" name="days" id="days" placeholder="Service Days" value="{{ $advisorDetails->days}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Start Time</label>
                <div class="controls">
                  <input type="text" name="start_time" id="start_time" placeholder="Time of Service" value="{{ $advisorDetails->start_time}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">End Time</label>
                <div class="controls">
                 <input type="text" name="end_time" id="end_time" placeholder="Time of Service" value="{{ $advisorDetails->end_time}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Current Status</label>
                <div class="controls">
                  <input type="text" name="status" id="status" placeholder="Available/Not Available" value="{{ $advisorDetails->status}}">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Advisor Details" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection