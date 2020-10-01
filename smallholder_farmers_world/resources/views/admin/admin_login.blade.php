@extends('layouts.adminLayout.admin_top_design')
<!DOCTYPE html>
<html lang="en">
<head>
        <title>SFW Admin Panel | Login</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/ico" href="{{asset('img/adminstrator.png')}}" />
    	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css') }}" />
        <link rel="stylesheet" href="{{asset('css/matrix-style.css')}}" />
        <link rel="stylesheet" href="{{asset('css/matrix-media.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css') }}" />
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
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
            <form id="loginform" class="form-vertical" method="POST" action="{{ url('admin') }}"> {{ csrf_field() }}
				 <div class="control-group normal_text"> <h4><img src={{ asset('img/adminstrator.png') }} style="width:130px;" alt="Logo" /></h4>
                 <br><h4> Smallholder Farmers World Admin Panel </h4>
                 </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input id="username" type="email" name="username" placeholder="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input id="password" type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" value="Login" class="btn btn-success" /></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info">Reecover</a></span>
                </div>
            </form>
        </div>
        <script src="{{asset('js/jquery.min.js')}}"></script>  
        <script src="{{asset('js/matrix.login.js')}}"></script> 
        <script src="{{asset('js/bootstrap.min.js')}}"></script> 
    </body>

</html>
