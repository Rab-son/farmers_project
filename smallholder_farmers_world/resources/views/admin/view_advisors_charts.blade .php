<?php
 
 $current_month = date('M');
 $last_month = date('M',strtotime("-1 month"));
 $last_to_last_month = date('M',strtotime("-2 month"));
  
 $dataPoints = array(
   array("y" => $last_to_last_month_advisors, "label" => $last_to_last_month),
   array("y" => $last_month_advisors, "label" => $last_month),
   array("y" => $current_month_advisors, "label" => $current_month)
 );
  
?>

@extends('layouts.adminLayout.admin_design')
@section('title','View Advisor Charts')
@section('content')
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Advisor Reporting"
	},
	axisY: {
		title: "Number of Advisors"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-advisor') }}">Add Advisor</a> <a href="{{ url('/admin/view-advisors') }}" class="current">View Advisors</a> </div>
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
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-advisors') }}" class="btn btn-primary btn-mini">Export</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-bar-chart"></i></span>
            <h5>Advisors Reporting </h5>
          </div>
          <div class="widget-content nopadding">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection