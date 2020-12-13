@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#">Supplier </a> <a href="#" class="current">Edit Supplier Details</a> </div>
    <h1>Supplier </h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit/Update Supplier Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-supplier/'.$supplierDetails->id) }}"  name="edit_supplier" id="edit_supplier" novalidate="novalidate">
              <div class="control-group">{{ csrf_field() }}
                <label class="control-label">Supplier Name</label>
                <div class="controls">
                  <input type="text" name="supplier_name" id="supplier_name" placeholder="Full Supplier Name" value="{{ $supplierDetails->supplier_name }}">
                </div>
              </div>
              <div class="control-group"> 
                <label class="control-label">District</label>
                <div class="controls">
                  <select style="width : 220px;" name="districtname"  id="district_id">
                      <option value="0" disabled selected>District Name</option>
                      @foreach($district as $cat)
		                	  <option value="{{$cat->id}}" >{{ucfirst($cat->districtname)}}</option>
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
                <label class="control-label">Supplier Phonenumber</label>
                <div class="controls">
                  <input type="text" name="supplier_phonenumber" id="supplier_phonenumber" value="{{ $supplierDetails->supplier_phonenumber}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Working Hours</label>
                <div class="controls">
                  <input type="text" name="working_hour" id="working_hour" value="{{ $supplierDetails->working_hour}}">
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
                <input type="submit" value="Edit / Update Details" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection