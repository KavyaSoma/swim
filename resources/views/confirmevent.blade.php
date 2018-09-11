@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- event code starts here -->
    <div class="container mycntn">
      <ol class="breadcrumb" style="border:1px solid #46A6EA;color:#46A6EA;">
 <li class="breadcrumb-item"><a style="color:#777;" href="{{url('addevent/'.$event_id)}}">Add Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('schedule-event/'.$event_id)}}">Schedule Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('venue-event/'.$event_id)}}">Event Venue</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('subevent/'.$event_id)}}">Sub Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('eventtime/'.$event_id)}}">Event Time</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('contact-event/'.$event_id)}}">Contact Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('club-event/'.$event_id)}}">Event Clubs</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('venue-subevent/'.$event_id)}}">SubEvent Venue</a></li>   
  <li class="breadcrumb-item">Confirm Event</li>
  </ol>
      <div class="row">
             <div class="col-xs-12 col-sm-3 kin_photo">
     <div class="fb-profile" style="margin-top:8%;">
  @if(count($event_image)>0)
 <img class="thumbnail profile_image" src="{{$event_image[0]->ImagePath}}" alt="Profile image">
 @else
 <img class="thumbnail profile_image" src="{{url('public/images/event.jpg')}}" alt="Profile image">
 @endif     <div class="fb-profile-text text-center">
       <h3 align="left">{{$event_details[0]->EventName}}</h3>
        <p>{{$event_details[0]->Description}}</p>
          <hr><p><i class="fa fa-share-alt"> </i> Share on social media</p>
 <div>

 <div style="text-align:left;">
<button class="btn btn-primary mybtn" style="width:100%;background:#00aced;"><a href="https://twitter.com/" target="blank" ><i class="fa fa-twitter myzommimg" aria-hidden="true"></i> Twitter</a></button>
<button class="btn btn-primary mybtn" style="width:100%;background: #3b5998;margin-top: 6px;"><a href="https://www.facebook.com/" target="blank" ><i class="fa fa-facebook myzommimg" aria-hidden="true"></i> Face book</a></button>
<button class="btn btn-danger mybtn" style="width:100%;margin-top: 6px;background:#dd4b39;"><a href="https://www.plus.google.com/" target="blank"><i class="fa fa-google-plus myzommimg" aria-hidden="true"></i> Google+</a></button>
</div>
     </div>
         <!-- <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:UK</p>-->
</div>
</div>
</div>
<div class="col-sm-8 col-xs-12" style="border-left:1px solid #eee">

<div class="col-sm-5 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">When</h4></legend>

<div class="col-sm-12" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" title="Edit" style="font-size: 17px;color:#f60"></i></a>

<h5 style="color:#46A6EA"><b>Schedule</b></h5>
<p>Occuarance : {{$schedulers[0]->ScheduleType}}</p>
@foreach($schedulers as $schedule)
  
 <p>Between {{$schedule->StartDateTime}} and {{$schedule->EndDateTime}} at {{$schedule->StartTime}}</p>        
 @endforeach                                      
</div>
</fieldset>
</div>
<div class="col-sm-7 col-xs-12">
<fieldset class="scheduler-border">
<legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Where</h4></legend>
<div class="" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" style="font-size: 17px;color:#f60" title="Edit"></i></a>
@foreach($venues as $venue)
<div class="col-sm-3">{{$venue->VenueName}}</div><div class="col-sm-7">: Vonkdoth Solutions</div>
<div class="col-sm-3">Address</div><div class="col-sm-7" style="word-break: break-all;">: Ghanpur Stn<br>
warangal<br>
Telangana<br>
506143</div>
@endforeach
</div>

</fieldset>
</div>
<div class="col-sm-12 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Sub Event</h4></legend>
<div class="row">
 
	<div class="col-sm-12" style="padding-left: 0;padding-right: 0;">
		<div class="col-sm-3" >
       @if(count($event_image)>0)
       <img alt="Profile image" class="img-rounded" style="width: 100%;" src="{{$event_image[0]->ImagePath}}">
 @else
 <img alt="Profile image" class="img-rounded" style="width: 100%;" src="{{url('public/images/event.jpg')}}">
 @endif
			
		</div>
    @foreach($event_details as $event)
		<div class="col-sm-4" >
		<div class="col-sm-6">SubEvent Name</div><div class="col-sm-6">: {{$event->EventName}}</div>	
		<div class="col-sm-6">Gender</div><div class="col-sm-6">: {{$event->Gender}}</div>	
		<div class="col-sm-6">Swim Style</div><div class="col-sm-6">: {{$event->SwimStyle}}</div>	
		<div class="col-sm-6">Course(mts)</div><div class="col-sm-6">: {{$event->Course}}</div>	
		<div class="col-sm-6">Participants</div><div class="col-sm-6">: {{$event->MinParticipants}} - {{$event->MaxParticipants}} </div>	
		<div class="col-sm-6">Age</div> <div class="col-sm-6">: {{$event->MinimumAge}} - {{$event->MaximumAge}} </div>	
		<div class="col-sm-6">Disabled</div> <div class="col-sm-6">:{{$event->AbleBodied}}</div>	
		</div>
   
		<div class="col-sm-5" >
			{{$event->SpecialInstructions}}
		</div>
			 @endforeach
		</div>
		
	</div></fieldset></div>
<div class="col-sm-6 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Event Time</h4></legend>

<div class="col-sm-12" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" title="Edit" style="font-size: 17px;color:#f60"></i></a>


 <p>Start date & Time : 12/12/12 & 12:12:12</p><br><br>
 <p>Start date & Time : 12/12/12 & 12:12:12</p> 
 
</div>
</fieldset>
</div>
<div class="col-sm-6 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Event Contact</h4></legend>

<div class="col-sm-12" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" title="Edit" style="font-size: 17px;color:#f60"></i></a>
<p>Contact : 040221252</p><br><br>
 <p>Mobile : 9966118834</p>
 <p>email : hareeshEdula@exmple.com</p>
                                    
</div>
</fieldset>
</div>
<div class="col-sm-6 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Event Venue</h4></legend>

<div class="col-sm-12" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" title="Edit" style="font-size: 17px;color:#f60"></i></a>
<div class="" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" style="font-size: 17px;color:#f60" title="Edit"></i></a>
<div class="col-sm-3">Venue Name</div><div class="col-sm-7">: Vonkdoth Solutions</div>
<div class="col-sm-3">Address</div><div class="col-sm-7" style="word-break: break-all;">: Ghanpur Stn<br>
warangal<br>
Telangana<br>
506143</div>
</div>
                                    
</div>
</fieldset>
</div>
<div class="col-sm-6 col-xs-12">
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><h4 class="col-sm-12" style="margin-top: 12%;">Event Club</h4></legend>

<div class="col-sm-12" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" title="Edit" style="font-size: 17px;color:#f60"></i></a>
<div class="" style="font-size:16px;height: 127px;overflow: auto;">
<a href="#"><i class="fa fa-edit pull-right" style="font-size: 17px;color:#f60" title="Edit"></i></a>
<div class="col-sm-3">Club Name</div><div class="col-sm-7">: Vonkdoth Solutions</div>
<div class="col-sm-3">Mobile</div><div class="col-sm-7" style="word-break: break-all;">: 9966118834<br>
<div class="col-sm-3">Email</div><div class="col-sm-7" style="word-break: break-all;">: hareeshEdula@exmple.com<br>
<div class="col-sm-3">Website</div><div class="col-sm-7" style="word-break: break-all;">: http://www.GhanpurStnwarangal.com<br>

</div>
                                    
</div>
</fieldset>
</div>





</div>
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                 
               <!--  <div class="board-inner">
            <ul class="nav nav-tabs nav_info" id="myTab"  style="margin:40px 25%">
                <div class="liner"></div>
                 <li>
                <a href="#" class="tab-one" title="Event Summary">
                  <span class="round-tabs">
                    <i class="fa fa-bullhorn"></i>
                  </span>
                 </a></li>
                 <li><a href="#" title="Sub Events">
                   <span class="round-tabs">
                     <i class="fa fa-list"></i>
                   </span>
                 </a>
                    </li>
                  <li><a href="#" title="Schedule">
                      <span class="round-tabs">
                           <i class="fa fa-calendar"></i>
                      </span> </a>
                      </li>

                      <li><a href="#" title="Contacts">
                          <span class="round-tabs">
                               <i class="fa fa-phone"></i>
                          </span>
                      </a></li>
                      <li><a href="#" title="Venue">
                          <span class="round-tabs">
                               <i class="fa fa-paper-plane-o"></i>
                          </span>
                      </a></li>

                      <li  class="active"><a href="#" title="Conform">
                          <span class="round-tabs">
                               <i class="fa fa-check"></i>
                          </span> </a>
                      </li>


                      </ul></div>
                       <div class="tab-content tab_details">
 
                                          <div class="tab-pane fade in active" id="eventconform">
                                            <div class="table-responsive">
                                              @if(count($event_details)>0)
                                              <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                  <th>Event Name</th>
                                                  <th>Swim Style</th>
                                                  <th>Team Size</th>
                                                  <th>Is Disabled</th>
                                                  <th>Age(Min-Max)</th>
                                                  <th>Participants (Min-Max)</th>
                                                </tr>
                                              </thead>
                                              @foreach($event_details as $event)
                                                <tr>
                                                  <td>{{$event->EventName}}</td>
                                                  <td>{{$event->SwimStyle}}</td>
                                                  <td>{{$event->MembersPerTeam}}</td>
                                                  <td>{{$event->AbleBodied}}</td>
                                                  <td>{{$event->MinimumAge}}-{{$event->MaximumAge}}</td>
                                                  <td>{{$event->MinParticipants}}-{{$event->MaxParticipants}}</td>
                                                </tr>
                                               @endforeach
                                              </table>
                                              @endif
                                            </div>
                                         <!--   <center><ul class="pagination">

          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
           <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
                                        </center>
										<div class="row" style="border: 1px solid #cdd1d1;margin-left: 0;margin-right: 0; border-radius:5px">
										    <div	class="col-sm-12">
                                            <div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
											<h5 style="color:#46A6EA"><b>Event Description</b></h5>
                                            <p>{{$event_descripiton}}</p>
                                            @if(count($venues)>0)</div>
                                            <div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
											<h5 style="color:#46A6EA"><b>Venue</b></h5>
                                            @foreach($venues as $venue)
                                            <p>{{$venue->VenueName}}</p>
                                            @endforeach
                                            @endif
                                            @if(count($schedulers)>0)</div>
                                            <div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
										<h5 style="color:#46A6EA"><b>Schedule</b></h5>
                                            @foreach($schedulers as $schedule)
                                            <p>Occuarance:{{$schedule->ScheduleType}}<br> Between {{$schedule->StartDateTime}} and {{$schedule->EndDateTime}} at {{$schedule->StartTime}}</p>
                                            @endforeach
                                            @endif
                                            @if(count($venues)>0)</div></div>
                                           <div	class="col-sm-7">
                                            <div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
										<h5 style="color:#46A6EA"><b>Address</b></h5>
                                            @foreach($venues as $venue)
                                            <p>{{$venue->AddressLine1}}<br>Post Code: {{$venue->PostCode}}<br> {{$venue->City}}</p>
                                            @endforeach
                                            @endif
                                            @if(count($clubs)>0)</div>
                                            <div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
										<h5 style="color:#46A6EA"><b>Clubs</b></h5>
                                            @foreach($clubs as $club)
                                            <p>Mobile:{{$club->ClubName}}<br>Email:{{$club->Email}}<br>Phone:{{$club->MobilePhone}}<br>Website:<a href="{{$club->Website}}" style="color:black">{{$club->Website}}</a></p>
                                            @endforeach
                                            @endif
                                            @if(count($venues)>0)</div><div style="box-shadow: 0 6px 4px #f8f8f8;width: 100%;padding: 10px;margin: 0;">
										<h5 style="color:#46A6EA"><b>Contact</b></h5>
                                            @foreach($contacts as $contact)
                                            <p>Mobile:{{$contact->Phone}}<br>Email:{{$contact->Email}}</p>
                                            @endforeach
                                            @endif</div>
                                            <br>
                                            <form method="post" action="{{url('confirm-event/'.$event_id)}}">
                                              {{csrf_field()}}
                                               @foreach($event_details as $event)
                                              <input type="hidden" name="event_name" value="{{$event->EventName}}">
                                              @endforeach
                                        
                                  
									  </div>
									  <div class="col-sm-5 " style="margin-top: 12px;">
										<img class="img-thumbnail myzommimg" src="{{url('public/images/0d73886bacb84059b8d1d72cbe31c162.jpg')}}" width="100%"alt="Here Image here">
									  </div><br>

                                                 </div><br>
												 
										<center><button type="submit" class="btn btn-primary mybtn">Submit</button></center>
										    </form>
                    </div>
                  </div>
                </div>-->
              </div></div>
              @endsection