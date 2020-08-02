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
                <label class="control-label">Supplier Location</label>
                <div class="controls">
                  <input type="text" name="supplier_location" id="supplier_location" placeholder="Location of The Supplier" value="{{ $supplierDetails->supplier_location}}">
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