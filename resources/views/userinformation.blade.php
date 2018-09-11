@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
      <!-- venue Public  code starts here -->
      <div class="container" id="main-code">
     @if(count($users)>0)
        <div class="fb-profile">
        @if($users[0]->Image == 'NA')
          <img align="left" class="profile_img thumbnail" src="{{url('public/images/User_M.jpg')}}" alt="Profile image"/>
        @else
        <img align="left" class="profile_img thumbnail" src="{{$users[0]->Image}}" alt="Profile image"/>
       @endif
        <div class="fb-profile-text">
         <h3>{{$users[0]->UserName}}</h3>
         <p>{{$users[0]->UserType}}</p>
        <hr>
      <center>
            <div class="col-sm-1 pull-right">
              @if(count($favourites)>0)
              <a href="{{url('user/'.$users[0]->ShortName.'/unfollow')}}"><button class="btn btn-default"><i class="fa fa-heart" style="color:#ff6600"></i> Unfollow</button></a>
              @else
                <a href="{{url('user/'.$users[0]->ShortName.'/following')}}"><button class="btn btn-default"><i class="fa fa-heart-o" style="color:#ff6600"></i> Follow</button></a>

                @endif
            </div>
            <div class="col-sm-2 pull-right">
              <a href="{{url('sendmessage')}}"><button class="btn btn-default"><i class="fa fa-envelope-o" style="color:#46A6EA"></i> Message</button></a>
            </div>
          </div>

</div>

<div class="container" style="margin-top:20px;background-color:#fff">
  <div class="row" style="margin-top:10%">
  <div class="panel panel-default magic-element isotope-item" style="margin-top:11px;">
    <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
      <h4 class="pb-title"style="padding:5px">Timeline</h4>
    </div>
    <div class="panel-body">

        <div class="col-sm-8">
      <h4 style="color:#46A6EA">Events</h4>
          <div class="panel panel-default col-xs-12 col-sm-12">
        <div class="panel-body">
          <div class="table table-responsive">
           @if(count($events)>0)
          <table class="table table-striped">
          <thead>
            <tr>
              <th>Event Name</th>
              <th>Subscribed</th>
              <th>View</th>
            </tr>
          </thead>
          @foreach($events as $event)
          <tbody>
            <tr>
              <td>{{$event->EventName}}</td>
              <td>{{$event->Status}}</td>
              <td><a href="{{url('event/'.$event->ShortName)}}"><button class="btn btn-primary view_btn">View</button></a></td>
            </tr>

          </tbody>
          @endforeach
        </table>
        @else
        <h4>No Subscribed Events</h4>
        @endif
      </div>
    </div>
      </div>
    </div>
  <div class="col-sm-4">
   <form class="form-horizontal">
            <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
              <div>
                <h4 class="field_names">Title</h4>
              </div>
              <p>{{$users[0]->Title}}</p><hr>
              <div>
                <h4 class="field_names">Date of Joining</h4>
              </div>
                <p>{{$users[0]->CreatedDate}}</p><hr>
                @foreach($address as $add)
              <div>
              <h4 class="field_names">Location</h4>
              </div>
                <p>{{$add->County}}</p><hr>
                <div>
                  <h4 class="field_names">Address</h4>
                </div>
                  <p>{{$add->City}},{{$add->Country}}</p><hr>
                  <div>
                   @endforeach
                    <h4 class="field_names">Contact</h4>
                  </div>
                    <p>Day Time : {{$users[0]->DayTimePhone}}</p>
                    <p>Evening Time : {{$users[0]->EveningPhone}}</p><hr>
                  </div>
                  @if(count($friends)>0)
                  <center><a href="{{url('addfriend/'.$users[0]->UserId)}}" class="btn btn-primary">Unfriend</a></center>
                  @else
                  <center><a href="{{url('addfriend/'.$users[0]->UserId)}}" class="btn btn-primary">Add Friend</a></center>
                  @endif
                </form>
                @endif
</div>

</div>
  </div>
    </div>
</div>
  </div>

</div>
  <!-- /panel -->
</div>
</div>
</div>
<!-- venue public code ends here -->
@endsection
