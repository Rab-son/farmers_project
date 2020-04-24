<!-- This code allows the admin to an update for the old password  -->
@extends('layouts.adminLayout.admin_design') 
@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Form elements</a> <a href="#" class="current">Common elements</a> </div>
  <h1>Common Form Elements</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-phone"></i> </span>
          <h5>Add Phone Number</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="#" method="get" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Enter Phone Number</label>
              <div class="controls">
                <select >
                  <option>First option</option>
                  <option>Second option</option>
                  <option>Third option</option>
                  <option>Fourth option</option>
                  <option>Fifth option</option>
                  <option>Sixth option</option>
                  <option>Seventh option</option>
                  <option>Eighth option</option>
                </select>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Register User</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-envelope"></i> </span>
          <h5>Send SMS To Users</h5>
        </div>
        <div class="widget-content nopadding">
            <div class="control-group">
              <form>
                <div class="controls">
                  <textarea class="textarea_editor span12" rows="4" placeholder="Enter text ..."></textarea>
                </div>
              </form>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Send Notification</button>
              </div>
            </div>
        </div>
      </div>

      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <h5>wysihtml5</h5>
      </div>
      <div class="widget-content">
        <div class="control-group">
          <form>
            <div class="controls">
              <textarea class="textarea_editor span12" rows="6" placeholder="Enter text ..."></textarea>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>


@endsection


