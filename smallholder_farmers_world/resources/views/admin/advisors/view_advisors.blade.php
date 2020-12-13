@extends('layouts.adminLayout.admin_design')
@section('title','View Advisors')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="{{ url('/admin/add-advisor')}}">Add Advisor</a> <a href="#" class="current">View Advisor</a> </div>
    <h1>Advisors</h1>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-group"></i></span>
            <h5>View Advisor Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Advisor Name</th>
                  <th>Specialty</th>
                  <th>Phone Number</th>
                  <th>EPA Name</th>
                  <th>District</th>
                  <th>Working Days</th>
                  <th>Working Hours</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($advisors as $advisor)
                <?php $i++ ?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i }} </td>
                  <td style="text-align: center"> {{ $advisor->advisor_name }}</td>
                  <td style="text-align: center"> {{ $advisor->specialty }}</td>
                  <td style="text-align: center">+ {{ $advisor->phone_number }}</td>
                  <td style="text-align: center"> {{ $advisor->advisor_epa }}</td>
                  <td style="text-align: center"> {{ $advisor->districtname }}</td>
                  <td style="text-align: center"> {{ $advisor->days }}</td>
                  <td style="text-align: center"> {{ $advisor->start_time }} To {{ $advisor->end_time }} </td>
                  <td style="text-align: center">  @if ($advisor->status==1)
                        <span style="color: green">Available</span>
                            @else 
                        <span style="color: red">Not Available</span>
                            @endif </td>
                  <td style="text-align: center"> 
                      <a href="{{ url('/admin/edit-advisor/'.$advisor->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a id="delAdvisor" href="{{ url('/admin/delete-advisor/'.$advisor->id) }}" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr>                  
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