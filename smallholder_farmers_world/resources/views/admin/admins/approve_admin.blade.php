@extends('layouts.adminLayout.admin_design')
@section('title','Approve Admin')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-advisor')}}">Add Admin</a> <a href="#" class="current">View Advisor</a> </div>
    <h1>Approve Adminstrator or Sub Adminstrator</h1>
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
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-user"></i> </span>
                        <h5>Adminstrator Name : {{ $adminDetails->username}} </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <ul class="recent-posts">
                            <li>
                                <div class="article-post">
                                    <span class="user-info">Adminstrator Type : {{ $adminDetails->type}} <b></b></span>
                                    <p>Current Status : 
                                        <b> @if($adminDetails->status==1)
                                                <span style="color: green"> Is Active</span>
                                            @else 
                                                <span style="color: red"> Is Not Active</span>
                                            @endif
                                        </b>
                                    </p>
                                </div>
                            </li>
                            <li>
                            <form method="post" action="{{ url('/admin/approve-admin/'.$adminDetails->id) }}" >
                                <legend>Approve This Person With These Roles </legend>
                                    {{ csrf_field() }}
                                    <div class="control-group"> 
                                        <div class="controls">
                                        <input type="text" name="type" id="type" placeholder="As email" readonly="" value="{{ $adminDetails->type}}" style="width:400px;">
                                        </div>
                                    </div>
                                    <div class="control-group"> 
                                        <div class="controls">
                                        <input type="text" name="username" id="username" placeholder="As email" readonly="" value="{{ $adminDetails->username}}" style="width:400px;">
                                        </div>
                                    </div>
                                    @if($adminDetails->type=="Sub Admin")
                                        <div class="control-group">
                                            <div class="controls">
                                            <input type="checkbox" name="farmers_access" id="farmers_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->farmers_access == "1") checked @endif>&nbsp;Farmers &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="markets_access" id="markets_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->markets_access == "1") checked @endif>&nbsp;Markets&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="suppliers_access" id="markets_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->suppliers_access == "1") checked @endif>&nbsp;Suppliers&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="advisors_access" id="advisors_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->advisors_access == "1") checked @endif>&nbsp;Advisors&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="ussd_notifications_access" id="ussd_notifications_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->ussd_notifications_access == "1") checked @endif>&nbsp;USSD Notifications
                                            </div>
                                        </div>
                                    @endif
                                    @if($adminDetails->type=="Admin")
                                        <div class="control-group">
                                            <div class="controls">
                                            <input type="checkbox" name="farmers_access" id="farmers_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->farmers_access == "0") checked @endif>&nbsp;Farmers &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="markets_access" id="markets_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->markets_access == "0") checked @endif>&nbsp;Markets&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="suppliers_access" id="markets_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->suppliers_access == "0") checked @endif>&nbsp;Suppliers&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="advisors_access" id="advisors_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->advisors_access == "0") checked @endif>&nbsp;Advisors&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="ussd_notifications_access" id="ussd_notifications_access" value="1" style="margin-top: -5px"
                                            @if($adminDetails->ussd_notifications_access == "0") checked @endif>&nbsp;USSD Notifications
                                            </div>
                                        </div>
                                    @endif
                                @if($adminDetails->status == 1)
                                    <button type="submit" class="btn btn-danger" name="status" id="status" value="0">Dismiss</button>
                                @else
                                    <button type="submit" class="btn btn-success" name="status" id="status" value="1">Approve</button>
                                @endif
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-group"></i></span>
                        <h5>Approved Adminstrators</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" role="form">
                            {{method_field("PUT")}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                            @if ($admin->status==1)
                            <tr>
                                <td style="text-align: center"> {{ $admin->username }}</td>
                                <td style="text-align: center; text-transform: capitalize"> {{ $admin->type }}</td>
                                <td style="text-align: center">
                                    <a href="{{ url('/admin/edit-admin/'.$admin->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                    <a href="#myModal2{{ $admin->id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                </td>
                            </tr>
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
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






  
  </div>
</div>
@endsection