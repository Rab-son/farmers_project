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
                    <div class="widget-title"> <span class="icon"> <i class="icon-file"></i> </span>
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
                                <form  method="post" action="{{ url('/admin/approve-admin/'.$adminDetails->id) }}" name="add_admin" id="edit_admin" novalidate="novalidate">{{ csrf_field() }}
                                    <legend>Approve This Person With These Roles </legend>
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
                                        <button type="submit" class="btn btn-danger" id="status" value="0">Dismiss</button>
                                    @else($adminDetails->status == 0)
                                        <button type="submit" class="btn btn-success" id="status" value="1">Approve</button>
                                    @endif
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>Approved List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" role="form">
                            {{method_field("PUT")}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Roles</th>
                                <th>Date Created</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead> 
                            <tbody>
                            @foreach()
                                <input type="hidden" name="id[]" value="">
                            <tr>
                                <td class="taskDesc">
                                    <input type="text" name="sku[]" id="sku" class="form-control" value="" required="required" style="width: 75px;">
                                </td>
                                <td class="taskStatus">
                                    <input type="text" name="size[]" id="size" class="form-control" value="" required="required" style="width: 75px;">
                                </td>
                                <td class="taskOptions">
                                    <input type="text" name="price[]" id="price" class="form-control" value="" required="required" style="width: 75px;">
                                </td>
                                <td class="taskOptions">
                                    <input type="text" name="stock[]" id="stock" class="form-control" value="" required="required" style="width: 75px;">
                                </td>
                                <td style="text-align: center; ">
                                    <button type="submit" class="btn btn-success btn-mini">Edit</button>
                                    <a href="javascript:" rel="" rel1="delete-attribute" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            -->
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