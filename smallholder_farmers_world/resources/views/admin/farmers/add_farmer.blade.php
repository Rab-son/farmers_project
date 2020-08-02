@extends('layouts.adminLayout.admin_design')
@section('title','Add Farmer')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/add-farmer') }}" title="Go to Add Farmer Section" class="current">Add Farmer</a> <a title="Go to View Farmers Section" href="{{ url('/admin/view-farmers')}} " class="tip-bottom">View Farmer</a>  </div>
    <h1>Farmers</h1>
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
            <h5>Add Farmer Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-farmer') }}" name="add_farmer" id="add_farmer" novalidate="novalidate">
              <div class="control-group"> {{ csrf_field() }}
                <label class="control-label">Farmer Name</label>
                <div class="controls">
                  <input type="text" name="farmer_name" id="farmer_name" placeholder="Full Name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone Number</label>
                <div class="controls">
                  <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Identification(ID) Number</label>
                <div class="controls">
                  <input type="text" name="id_number" id="id_number" placeholder="ID Number">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Location</label>
                <div class="controls">
                  <input type="text" name="location" id="location" placeholder="Current Residence">
                </div>
              </div>
<!--
            <div class="control-group">
              <label class="control-label">Date Picker (mm-dd)</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
-->
              <div class="control-group">
                <label for="dob" class="control-label">Date of Birth</label>
                <div class="controls{{$errors->has('dob')?' has-error':''}}">
                    <div class="input-prepend">
                        <div  data-date="12-02-2012" class="input-append date datepicker">
                            <input type="text" name="dob" id="dob" value="{{old('dob')}}"  data-date-format="yyyy-mm-dd" class="span11" placeholder="yyyy-mm-dd">
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                    <span class="text-danger">{{$errors->first('dob')}}</span>
                </div>
              </div>
<!--
              <div class="control-group">
                <label class="control-label">Birthday Date</label>
                <div class="controls">
                  <input type="text" name="dob" id="dob" placeholder="YY-MM-DD">
                </div>
              </div>

-->
              <div class="control-group">
                <label class="control-label">Sex</label>
                <div class="controls">
                  <input type="text" name="sex" id="sex" placeholder="Gender">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Farm Activity</label>
                <div class="controls">
                  <input type="text" name="farm_activity" id="farm_activity" placeholder="Farm Business Involved">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Next of Kin</label>
                <div class="controls">
                  <input type="text" name="next_of_kin" id="next_of_kin" placeholder="Farm Activity Successor">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Farmer" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
