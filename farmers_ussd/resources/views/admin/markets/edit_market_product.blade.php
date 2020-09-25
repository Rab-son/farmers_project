@extends('layouts.adminLayout.admin_design')
@section('title','Add Market Product ')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a><a href="{{ url('/admin/add-items') }}" class="current">Add Market Product</a> <a href="{{ url('/admin/view-products') }}">View Market Product</a>  </div>
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
    <a id="example" data-content="Click the button in order to view your Updated market product" data-placement="top" data-toggle="popover" href="{{ url('/admin/view-market-products') }}" class="btn btn-success btn-mini" data-original-title="Updated Market Product">View Updated Market Product</a>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-envelope"></i> </span>
            <h5>Edit Market Products</h5>
          </div>
          <div class="widget-content nopadding">
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-market-product/'.$marketProductDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate"> {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Market Name</label>
                <div class="controls">
                  <select name="market_id" id="market_id" style="width: 590px;">
                    <?php echo $markets_drop_down; ?>
                  <select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Products Buying</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $marketProductDetails->product_name }}" style="width: 578px;">
                </div>
              </div>
              <div class="control-group">
                  <label for="sent_message" class="control-label">Description</label>
                  <div class="controls">
                      <textarea class="textarea_editor span12" name="description" id="description" rows="6" placeholder="Start Typing Here To Send Notification" style="width: 590px;">
                        {{ $marketProductDetails->description }}
                      </textarea>
                  </div>
              </div>
              <div class="control-group">
                  <label for="sent_message" class="control-label">Price</label>
                  <div class="controls">
                      <input type="text" name="buying_price" id="buying_price" style="width: 90px;" placeholder="Buying Price" value="{{ $marketProductDetails->buying_price}}" required>
                      <input type="text" name="selling_price" id="selling_price" style="width: 90px;" placeholder="Selling Price" value="{{ $marketProductDetails->selling_price}}" required>
                  </div>
                  <label for="sent_message" class="control-label">Amount</label>
                  <div class="controls">
                      <input type="text" name="amount" id="amount" style="width: 90px;" placeholder="amount" value="{{ $marketProductDetails->amount}}" required>
                  </div>
                <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                        <input type="checkbox" name="status" id="status" value="1" @if($marketProductDetails->status == "1") checked @endif>
                    </div>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
