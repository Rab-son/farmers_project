@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Farmers </a> <a href="#" class="current">Edit Farmer Details</a> </div>
    <h1>Farmers </h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Farmer</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-farmer/'.$farmerDetails->id) }}"  name="edit_farmer" id="edit_farmer" novalidate="novalidate">
              <div class="control-group">{{ csrf_field() }}
                <label class="control-label">Farmer Name</label>
                <div class="controls">
                  <input type="text" name="farmer_name" id="farmer_name" placeholder="Full Name" value="{{ $farmerDetails->full_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone Number</label>
                <div class="controls">
                  <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ $farmerDetails->phonenumber}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Identification(ID) Number</label>
                <div class="controls">
                  <input type="text" name="id_number" id="id_number" placeholder="ID Number" value="{{ $farmerDetails->id_number}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Location</label>
                <div class="controls">
                  <input type="text" name="location" id="location" placeholder="Current Residence" value="{{ $farmerDetails->location}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Birthday Date</label>
                <div class="controls">
                  <input type="text" name="dob" id="dob" placeholder="Year/Month/Day" value="{{ $farmerDetails->birthday_date}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sex</label>
                <div class="controls">
                  <input type="text" name="sex" id="sex" placeholder="Gender" value="{{ $farmerDetails->sex}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Farm Activity</label>
                <div class="controls">
                  <input type="text" name="farm_activity" id="farm_activity" placeholder="Farm Business Involved" value="{{ $farmerDetails->farm_activity}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Next of Kin</label>
                <div class="controls">
                  <input type="text" name="next_of_kin" id="next_of_kin" placeholder="Farm Activity Successor" value="{{ $farmerDetails->next_of_kin}}">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Farmer Details" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection