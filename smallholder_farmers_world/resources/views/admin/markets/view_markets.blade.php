@extends('layouts.adminLayout.admin_design')
@section('title','View Markets')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="{{ url('/admin/add-market') }}">Add Market</a> <a href="{{ url('/admin/view-markets') }}" class="current">View Market </a> </div>
    <h1>Markets</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>

  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-markets') }}" class="btn btn-primary btn-mini"><span class="icon"><i class="icon-book"></i></span> Export To Excel</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-group"></i></span>
            <h5>View Markets Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Market Name</th>
                  <th>Market Location</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($markets as $market )
                <?php $i++?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i}} </td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $market->mark_name }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $market->mark_location }}</td>
                  <td style="text-align: center"> 
                      <a href="#myModal{{ $market->mark_id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a href="{{ url('/admin/edit-market/'.$market->mark_id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a href="#myModal2{{ $market->mark_id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr> 
                  <div id="myModal{{ $market->mark_id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style="text-align: center; text-transform: uppercase">{{ $market->mark_name }} Details</h3>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center; text-transform: capitalize">Market Name  : {{ $market->mark_name }} </p>
                      <p style="text-align: center; text-transform: capitalize">Location     : {{ $market->mark_location }} </p>
                    </div>
                  </div>
                  <div id="myModal2{{ $market->mark_id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style = "text-align: center"> You Want To Delete {{ $market->mark_name }} Details ?</h3>
                    </div>
                    <div class="modal-body">
                        <h6 style ="text-align: center; color: red">Once You Delete The Details You Will Not Be Able To Recover It</h6>
                    </div>
                    <div class="modal-footer"> 
                      <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a> 
                      <a href="{{ url('/admin/delete-market/'.$market->mark_id) }}" id="add-event-submit" class="btn btn-danger">Proceed To Delete</a> 
                    </div>
                  </div>                 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection