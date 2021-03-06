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

          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-market') }}" name="add_market" id="add_market" novalidate="novalidate">
              <div class="control-group"> {{ csrf_field() }}
                <label class="control-label">Market Name</label>
                <div class="controls">
                  <input type="text" name="mark_name" id="mark_name" placeholder="e.g Mzimba Admarc">
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
<<<<<<< HEAD
                  <select style="width : 220px;" name="epaname" id="epaname" type="epa">
=======
                  <select style="width : 220px;" name="epaname" id="epaname">
>>>>>>> b93bc578f52316868abdf6ac085cdba739fb774f
                  <option value="0" disabled selected>EPA Name</option>
                  </select>
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