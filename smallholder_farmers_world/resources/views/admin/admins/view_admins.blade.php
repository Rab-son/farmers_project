@extends('layouts.adminLayout.admin_design')
@section('title','View Admins')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-farmer') }}">Add Admin</a> <a href="{{ url('/admin/view-admins') }}" class="current">View Admin</a> </div>
    <h1>Adminstrators</h1>
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
            <h5>View Admins Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Admin Name</th>
                  <th>Position</th>
                  <th>Roles</th>
                  <th>Status</th>
                  <th>Created On</th>
                  <th>Updated On</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin) 
                <?php $i++; 
                      if($admin->type=="Admin"){
                        $roles = "All";
                      }else{
                        $roles ="";
                        if($admin->farmers_access==1){
                          $roles .="Farmers,\t";
                        }
                        if($admin->markets_access==1){
                          $roles .="Markets,\t";
                        }
                        if($admin->advisors_access==1){
                          $roles .="Advisors,\t";
                        }
                        if($admin->suppliers_access==1){
                          $roles .="Suppliers,\t";
                        }
                        if($admin->ussd_notifications_access==1){
                          $roles .="USSD Notifications,\t";
                        }
                      }
                ?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i}}  </td>
                  <td style="text-align: center"> {{ $admin->username }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $admin->type }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $roles }}</td>
                  <td style="text-align: center; text-transform: capitalize"> 
                    @if ($admin->status==1)
                      <span style="color: green">Active</span>
                    @else 
                      <span style="color: red">Inactive</span>
                    @endif
                  </td>
                  <td style="text-align: center; text-transform: uppercase"> {{ $admin->created_at }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $admin->updated_at }}</td>
                  <td style="text-align: center">
                    @if ($admin->status==0) 
                      <a href="{{ url('/admin/approve-admin/'.$admin->id) }}" class="btn btn-info btn-mini">
                          Approve
                      </a> 
                      @else
                      <a href="{{ url('/admin/approve-admin/'.$admin->id) }}" class="btn btn-danger btn-mini">
                          Dismiss
                      </a>
                    @endif
                      <a href="#myModal{{ $admin->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a href="{{ url('/admin/edit-admin/'.$admin->id) }}" class="btn btn-primary btn-mini">Edit</a>
                    <!--  <a href="#myModal2{{ $admin->id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a> -->
                  </td>
                </tr> 
                  <div id="myModal{{ $admin->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style="text-align: center; text-transform: capitalize; color: black">{{ $admin->username }} Full Details</h3>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center; text-transform: capitalize" >Type        : {{ $admin->type }} </p>
                      <p style="text-align: center; text-transform: capitalize" >Status      : @if ($admin->status==1)
                        <span style="color: green">Approved</span>
                            @else 
                        <span style="color: red">Not Approved</span>
                            @endif 
                      </p>
                      <p style="text-align: center; text-transform: capitalize" >Roles        : {{$roles}}
                      </p>
                    </div>
                  </div>
                  <div id="myModal2{{ $admin->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style = "text-align: center"> You Want To Delete {{ $admin->username }} Details ?</h3>
                    </div>
                    <div class="modal-body">
                        <h6 style ="text-align: center; color: red">Once You Delete The Details You Will Not Be Able To Recover It</h6>
                    </div>
                    <div class="modal-footer"> 
                      <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a> 
                      <a href="{{ url('/admin/delete-admin/'.$admin->id) }}" id="add-event-submit" class="btn btn-danger">Proceed To Delete</a> 
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