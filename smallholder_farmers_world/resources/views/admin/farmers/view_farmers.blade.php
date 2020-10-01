@extends('layouts.adminLayout.admin_design')
@section('title','View Farmers')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-farmer') }}">Add Farmer</a> <a href="{{ url('/admin/view-farmers') }}" class="current">View Farmer</a> </div>
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
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-farmers') }}" class="btn btn-primary btn-mini"><span class="icon"><i class="icon-book"></i></span> Export To Excel</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-group"></i></span>
            <h5>View Farmers Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Farmer Name</th>
                  <th>Location</th>
                  <th>Phone Number</th>
                  <th>Farmer ID Number</th>
                  <th>Farm Activity</th>
                  <th>Gender</th>
                  <th>Next of Kin</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($farmers as $farmer) 
                <?php $i++; ?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i}}  </td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $farmer->full_name }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $farmer->location }}</td>
                  <td style="text-align: center">  {{ $farmer->phonenumber }}</td>
                  <td style="text-align: center; text-transform: uppercase"> {{ $farmer->id_number }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $farmer->farm_activity }}</td>
                  <td style="text-align: center; text-transform: capitalize">  @if ($farmer->sex==1)
                        <span style>Male</span>
                            @else 
                        <span style>Female</span>
                            @endif </td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $farmer->next_of_kin }}</td>
                  <td style="text-align: center"> 
                      <a href="#myModal{{ $farmer->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a href="{{ url('/admin/edit-farmer/'.$farmer->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a href="#myModal2{{ $farmer->id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr> 
                  <div id="myModal{{ $farmer->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style="text-align: center; text-transform: uppercase; color: black">{{ $farmer->full_name }} Full Details</h3>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center; text-transform: capitalize" >ID Number    : {{ $farmer->id_number }} </p>
                      <p style="text-align: center; text-transform: capitalize">Location     : {{ $farmer->location }} </p>
                      <p style="text-align: center; text-transform: capitalize">Phone Number : + {{ $farmer->phonenumber }} </p>
                      <p style="text-align: center; text-transform: capitalize">Farm Activity: {{ $farmer->farm_activity }} </p>
                      <p style="text-align: center; text-transform: capitalize">Gender:   @if ($farmer->sex==1)
                        <span style>Male</span>
                            @else 
                        <span style>Female</span>
                            @endif </td> </p>
                      <p style="text-align: center; text-transform: capitalize">Next of Kin  : {{ $farmer->next_of_kin }}</p>
                    </div>
                  </div>
                  <div id="myModal2{{ $farmer->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style = "text-align: center"> You Want To Delete {{ $farmer->full_name }} Details ?</h3>
                    </div>
                    <div class="modal-body">
                        <h6 style ="text-align: center; color: red">Once You Delete The Details You Will Not Be Able To Recover It</h6>
                    </div>
                    <div class="modal-footer"> 
                      <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a> 
                      <a href="{{ url('/admin/delete-farmer/'.$farmer->id) }}" id="add-event-submit" class="btn btn-danger">Proceed To Delete</a> 
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