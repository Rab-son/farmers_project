@extends('layouts.adminSignUp.admin_design')
@section('title','SFW Admin Panel | Register')
@section('content')
        <div id="loginbox">
            <!-- Displaying an error message when the user has provided wrong credintials -->  
            @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif         
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
            <form class="loginform" class="form-vertical" method="POST" action="{{ url('/admin/admin-register') }}" name="password_validate1" id="password_validate1" novalidate="novalidate"> {{ csrf_field() }}
				 <div class="control-group normal_text"> 
                 <br><h4 > SFW Adminstrator Registration </h4>
                 </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input name="username" type="email" placeholder="Email Address" required="" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-key"></i></span><input name="password" type="password" id="password" placeholder="Password" required="" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-key"></i></span><input name="confirm_pwd" id="confirm_pwd" type="password" placeholder="Confirm Password" required="" />
                        </div>
                    </div>
                </div>
                <div class="control-group"> 
                <div class="controls">
                <!--
                <div class="main_input_box">
                    <select name="type" readonly="" id="type" style="width :360px;">
                    <option value="Admin">Admin</option>
                    <option value="Sub Admin">Sub Admin</option>
                    </select>
                </div>
                -->
                <div class="main_input_box">
                    <select name="type" readonly="" id="type"  style="width :360px;">
                    <option value="Admin">Admin</option>
                    <option value="Sub Admin">Sub Admin</option>
                    </select>
                </div>

                </div>
                </div>
                <div class="control-group" id="access">
                    <label class="control-group normal_text">Choose Roles</label>
                    <div class="control-group normal_text">
                    <input type="checkbox" name="farmers_access" id="farmers_access" value="1" style="margin-top: -5px">
                    &nbsp;Farmers &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="markets_access" id="farmers_access" value="1" style="margin-top: -5px">
                    &nbsp;Markets&nbsp;&nbsp;&nbsp;<br/><br/>
                    <input type="checkbox" name="suppliers_access" id="farmers_access" value="1" style="margin-top: -5px">
                    &nbsp;Suppliers&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="advisors_access" id="farmers_access" value="1" style="margin-top: -5px">
                    &nbsp;Advisors&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="ussd_notifications_access" id="farmers_access" value="1" style="margin-top: -5px">
                    &nbsp;USSD Notifications
                    </div>
                </div>
<!--
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-key"></i></span><input name="password" type="password" placeholder="Confirm Password" required="" />
                        </div>
                    </div>
                </div>
            -->
                <div class="form-actions">
                    <span class="pull-left"><a href="{{ url('admin') }}" class="flip-link btn btn-info">Back To Login</a></span>
                    <span class="pull-right"><input type="submit" value="Register" class="btn btn-success" /></span>
                </div>
            </form>

        </div>
        <script src="{{asset('js/jquery.min.js')}}"></script>  
        <script src="{{asset('js/matrix.login.js')}}"></script> 
        <script src="{{asset('js/bootstrap.min.js')}}"></script> 
@endsection
