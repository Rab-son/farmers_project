@extends('layouts.adminLayout.admin_design')
@section('title','Add Market')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="{{ url('/admin/add-market')}}" class="current">Add Market</a>  <a href="{{ url('/admin/view-markets')}}">View Market</a>  </div>
    <h1>Markets</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-user"></i></span>
            <h5>Add Market Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-market') }}" name="add_market" id="add_market" novalidate="novalidate">
              <div class="control-group"> {{ csrf_field() }}
                <label class="control-label">Market Name</label>
                <div class="controls">
                  <input type="text" name="mark_name" id="mark_name" placeholder="Market Full Name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Market Location</label>
                <div class="controls">
                  <input type="text" name="mark_location" id="mark_location" placeholder="Location For The Market">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Market" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection