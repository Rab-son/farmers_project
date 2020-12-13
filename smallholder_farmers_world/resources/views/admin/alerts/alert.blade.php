@extends('layouts.adminLayout.admin_design') 
@section('content')

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="{{ url('/admin/dashboard') }}" title="Dashboard" class="tip-bottom">
    <i class="icon-dashboard"></i> Dashboard</a>
    <a href="{{ url('/admin/view-farmers') }}" title="Newly Registered farmers" class="tip-bottom">
    <i class="icon-phone"></i> Registerd By USSD <span class="label label-important">{{$count1->total()}}</span></a>
    <a href="{{ url('/admin/view-farmers') }}" title="Number of Newly Registered farmers" class="tip-bottom">
    <i class="icon-laptop"></i>Registerd By Administrator <span class="label label-important">{{$count->total()}}</span></a>
    <a href="{{ url('/admin/view-notifications') }}" title="Number of Unread Messages" class="tip-bottom">
    <i class="icon-inbox"></i> Unread Messages By USSD <span class="label label-important">{{$message->total()}}</span></a></div>

  </div>
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

<div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Recent Notifications</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
                      @foreach ($farmers as $farmer)
                      <?php $i++?>
                      @if ($farmer->status==1 || $farmer->status==2)
                      <form class="form-horizontal" method="post" action="{{ url('/admin/alert/'.$farmer->id) }}" name="add_farmer" id="add_farmer" novalidate="novalidate">
                      {{ csrf_field() }}
                      <li>
                      <div class="fr">
                      <div class="form-actions">
                           <button type="submit" class="btn btn-success btn-mini" name="status" id="status" value="0">Mark As Read</button>    
                      </div>
                      </div>
                        @if ($farmer->status==1)
                        <div class="article-post"> <span class="user-info">{{ $i}} {{ $farmer->full_name }}  </span>
                        <p> Of {{ $farmer->phonenumber }} Has Been Registered By USSD on  {{ $farmer->created_at }}  <a href="#"></a></p>
                        </div>
                        @else($farmer->status==2)
                        <div class="article-post"> <span class="user-info">{{ $i}} {{ $farmer->full_name }}  </span>
                        <p> Of {{ $farmer->phonenumber }} Has Been Registered By Web Administrator on {{ $farmer->created_at }}  <a href="#"></a></p>
                        </div>
                        @endif
                      </li>
                    </form>
                      
                      @endif
                      @endforeach
                    </li>
                    <li>
                    <a href="{{ url('/admin/view-farmers') }}"><button class="btn btn-warning btn-mini">View All</button></a>
                    </li>
                  </ul>

          </div>

        </div>
      </div>
    </div>
</div>



<!--End-breadcrumbs-->

</div>

<!--end-main-container-part-->

@endsection


