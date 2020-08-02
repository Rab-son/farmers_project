@extends('layouts.adminLayout.admin_design')
@section('title','View Market Products')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i> Dashboard</a> <a href="{{ url('/admin/add-items') }}">Add Market Product</a> <a href="{{ url('/admin/view-market-products') }}" class="current">View Market Product</a></div>
    <h1>Market Products</h1>
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
    <a id="example" data-content="Click the button to view market product" data-placement="top" data-toggle="popover" 
    href="{{ url('/admin/view-market-products') }}" class="btn btn-primary btn-mini"  data-original-title="View Market Product">View  Market Product</a>
    <a id="example" data-content="Click the button to view farmer produce" data-placement="top" data-toggle="popover" 
     href="{{ url('/admin/view-farmer-products') }}" class="btn btn-primary btn-mini" data-original-title="View Farmer Produce">View Farmer Produce</a>
    <a id="example" data-content="Click the button to view supplier product" data-placement="top" data-toggle="popover" 
    href="{{ url('/admin/view-supplier-products') }}" class="btn btn-primary btn-mini" data-original-title="View Supplier Product">View Supplier Product</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <!-- Market Products -->
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-envelope"></i></span>
            <h5>Market Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Market Name</th>
                  <th>Name</th>
                  <th>Selling Price</th>     
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Attributes</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr class="gradeX">
                  <td style="text-align: center; text-transform: capitalize">{{ $product->mark_name }}</td>
                  <td style="text-align: center; text-transform: capitalize">{{ $product->product_name }}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $product->selling_price}}</td>
                  <td style="text-align: center; text-transform: capitalize"> {{ $product->buying_price }}</td>
                  <td style="text-align: center; text-transform: capitalize"> 
                    @if ($product->status==1)
                      <span style="color: green">Available</span>
                    @else 
                      <span style="color: red">Unavailable</span>
                    @endif
                  </td>
                  <td style="text-align: center;"><a href="#myModal{{ $product->id }}" data- class="btn btn-success btn-mini">View Other Attr</a></td>
                  <td style="text-align: center"> 
                      <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a href="{{ url('/admin/edit-market-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a href="#myModal2{{ $product->id }}" data-toggle="modal" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr> 
                  <div id="myModal{{ $product->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style="text-align: center; text-transform: uppercase; color: black">{{ $product->mark_name}} Full Details</h3>
                    </div>
                    <div class="modal-body">
                      <p style="text-align: center; text-transform: capitalize" >Product Name   : {{ $product->product_name }} </p>
                      <p style="text-align: center; text-transform: capitalize" >Selling Price  : {{ $product->selling_price }} </p>
                      <p style="text-align: center; text-transform: capitalize" >Buying Price   : {{ $product->buying_price }} </p>
                    </div>
                  </div>
                  <div id="myModal2{{ $product->id }}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3 style = "text-align: center"> You Want To Delete {{ $product->product_name }} Details ?</h3>
                    </div>
                    <div class="modal-body">
                        <h6 style ="text-align: center; color: red">Once You Delete The Details You Will Not Be Able To Recover It</h6>
                    </div>
                    <div class="modal-footer"> 
                      <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a> 
                      <a href="{{ url('/admin/delete-market-product/'.$product->id) }}" id="add-event-submit" class="btn btn-danger">Proceed To Delete</a> 
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



</div>
</div>
@endsection