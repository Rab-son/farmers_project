@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#">Market </a> <a href="#" class="current">Edit Market Details</a> </div>
    <h1>Market </h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit/Update Market Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-market/'.$marketDetails->mark_id) }}"  name="edit_market" id="edit_market" novalidate="novalidate">
              <div class="control-group">{{ csrf_field() }}
                <label class="control-label">Market Name</label>
                <div class="controls">
                  <input type="text" name="mark_name" id="mark_name" placeholder="Full Market Name" value="{{ $marketDetails->mark_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Market Location</label>
                <div class="controls">
                  <input type="text" name="mark_location" id="mark_location" placeholder="Location of The Market" value="{{ $marketDetails->mark_location}}">
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