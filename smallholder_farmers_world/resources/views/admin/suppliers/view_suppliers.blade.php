@extends('layouts.adminLayout.admin_design')
@section('title','View Suppliers')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="{{ url('/admin/add-supplier') }}">Add Supplier</a> <a href="{{ url('/admin/view-suppliers') }}" class="current">View Supplier </a> </div>
    <h1>Suppliers</h1>
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
            <h5>View Suppliers Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>EPA Name</th>
                  <th>District</th>
                  <th>Working Hours</th>
                  <th>Working Days</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($suppliers as $supplier)
                <?php $i++ ?>
                <tr class="gradeX">
                  <td style="text-align: center"> {{ $i}} </td>
                  <td style="text-align: center"> {{ $supplier->supplier_name }}</td>
                  <td style="text-align: center"> {{ $supplier->supplier_phonenumber }}</td>
                  <td style="text-align: center"> {{ $supplier->supplier_epa }}</td>
                  <td style="text-align: center"> {{ $supplier->districtname }}</td>
                  <td style="text-align: center"> {{ $supplier->working_hour }}</td>
                  <td style="text-align: center"> {{ $supplier->working_day }}</td>
                  <td style="text-align: center"> 
                      <a href="{{ url('/admin/edit-supplier/'.$supplier->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a id="delSupplier" href="{{ url('/admin/delete-supplier/'.$supplier->id) }}" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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