@extends('layouts.adminLayout.admin_design')
@section('title','View Admins')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-farmer') }}">Add Admin</a> <a href="{{ url('/admin/view-admins') }}" class="current">View Admin</a> </div>
    <h1>Calculations</h1>
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
      <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Maize Yield Estimation</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Amount of Kgs</label>
              <div class="controls">
                <select name="amountofkgs">
                  <option>Select</option>
                  <option>50Kgs</option>
                  <option>70Kgs</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Number of Bags</label>
              <div class="controls">
                <input name="numberofBags" type="number" min="1" class="span11" placeholder="1 or 2 or 3 ...." required/>
              </div>
            </div>
            <div class="form-actions">
              <button name ="submit" type="submit" class="btn btn-success">Calculate</button>
            </div>
            <?php 
                if(isset($_GET['submit'])){
                  $result1 = $_GET['numberofBags'];
                  $result2 = $_GET['amountofkgs'];
                  
                  switch($result2){
                    case "Select":
                      echo "Please Select 50 or 70";
                    case "50Kgs":
                      $maizeYieldOf50kgs = 50 * 0.016;
                      $npkBags = 0.04 * $result1;
                      $ureaBags = 0.04 * $result1;
                      echo"<center><strong> For $result1 Maize Bag(s) of 70Kgs, You will need <b>$maizeYieldOf50kgs </b> hectares of land <br>
                            <b>$npkBags </b> NPK Fertilizer Bag(s) <b> $ureaBags </b> Urea Fertilizer Bag(s) With Moderate rainfall.
                           </strong><center>";
                    break;
                    case "70Kgs";
                    $maizeYieldOf70kgs = 70 * 0.0224;
                    $npkBags = 0.0224 * $result1;
                    $ureaBags = 0.0224 * $result1;
                    echo"<center><strong> For $result1 Maize Bag(s) of 50Kgs, You will need <b>$maizeYieldOf70kgs </b> hectares of land <br>
                          <b>$npkBags </b> NPK Fertilizer Bag(s) <b> $ureaBags </b> Urea Fertilizer Bag(s) With Moderate rainfall.
                         </strong><center/>";

                    break;
                  }
                }
            ?>
          </form>

        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection