@extends('layouts.adminLayout.admin_design') 
@section('content')

<body>
  <div class="container">
    <div class="jumbotron">
      <div class="row">
        <div class="col">
          <div class="card">
              <div class="card-header">Add Phone Number
              </div>
              <div class="card-body">
              /*
              <form method="POST">
                  @csrf
                <div class="form-group"><label>Enter Phone Number</label>
                <input type="tel" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                </div>
                    <button type="submit" class="btn btn-primary">Register User</button>  
              </form>
              */
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
                <div class="card-header">
                    Send SMS message
                </div>
              /*
                <div class="card-body">
                  <form method="POST" action="/custom">
                    @csrf
                    <div class="form-group"><label>Select users to notify</label>
                        <select name="users[]" multiple class="form-control">
                            @foreach ($users as $user)
                            <option>{{$user->phone_number}}</option>
                            @endforeach
                        </select>
                */
                    </div>
                        <div class="form-group">
                            <label>Notification Message</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection


