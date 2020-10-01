@extends('layouts.adminLayout.admin_design')
@section('title','Add Supplier')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="{{url('/admin/add-supplier')}}" class="current">Add Supplier</a> <a href="{{ url('/admin/view-suppliers') }}">View Supplier</a> </div>
    <h1>Suppliers</h1>
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
            <h5>Add Supplier Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-supplier') }}" name="add_supplier" id="add_supplier" novalidate="novalidate">
              <div class="control-group"> {{ csrf_field() }}
                <label class="control-label">Supplier Name</label>
                <div class="controls">
                  <input type="text" name="supplier_name" id="supplier_name" placeholder="e.g Lusinje Sayenda Ltd">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Supplier Location</label>
                <div class="controls">
                  <input type="text" name="supplier_location" id="supplier_location" placeholder="e.g Zomba">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Supplier Phonenumber</label>
                <div class="controls">
                  <input type="text" name="supplier_phonenumber" id="supplier_phonenumber" placeholder="e.g 0886788210">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Working Hours</label>
                <div class="controls">
                  <input type="text" name="working_hour" id="working_hour" placeholder="e.g 7AM-5PM">
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">Working Days</label>
                <div class="controls">
                  <select name="working-day" id="working-day" style="width : 220px;">
                    <option value="Monday-Sunday">Monday-Sunday</option>
                    <option value="Monday-Saturday">Monday-Saturday</option>
                    <option value="Monday-Friday">Monday-Friday</option>
                  </select>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Supplier" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection