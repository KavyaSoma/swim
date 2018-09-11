@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Dashboard code starts here -->
<div class="container" id="main-code">
    <br/>    
    <ul class="nav nav-tabs preview_tabs">
      <li><a href="{{url('/events')}}">All Events</a></li>
      <li class="active"><a href="javascript:;">My Events</a></li>
    </ul>
  <section class="main" style="margin-top:20px">
    <div class="col-xs-12 col-sm-6">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default active col-md-12">
              <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingOne">
                  <h3 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span class="glyphicon glyphicon-calendar"></span> 
                      Upcoming Events <span class="badge"></span></a><br></a>
                  </h3>
              </div>
                <div id="collapseOne" class="panel-collapse collapse in"  role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body"  id="user_scroll">
                  @if(count($upcomingevents)>0)
                  @foreach($upcomingevents as $upcoming)
                  <ul class="media-list">
                      <li class="media">
                             @php
                          $pieces = explode(' ',$upcoming->StartDateTime);
                          $date = $pieces[0];
                          $slices = explode('-',$date);
                          $year = $slices[0];
                          $month = $slices[1];
                          $day = $slices[2];
                          $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',07=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
                          @endphp
                          <div class="media-left">
                              <div class="panel panel-default text-center date">
                                  <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                      <span class="panel-title strong">
                                          {{$months[(int)$month]}}
                                      </span>
                                  </div>
                                  <div class="panel-body day text-default" style="color:#46A6EA">
                                       {{$day}}
                                  </div>
                              </div>
                          </div>
                          <div class="media-body event-name" style="text-align: left;">
                              <h4 class="media-heading">
                                  {{$upcoming->EventName}}
                              </h4>
                                {{ substr($upcoming->Description,0,150)}}
                            </div>
                          <div class="media-right">
                          <a href="{{url('editevent/'.$upcoming->EventId)}}" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="{{url('event/'.$upcoming->ShortName)}}" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
                              </p>
                          </div>
                      </li>
                     </ul>
                   @endforeach
                                              @else
                                            
                           
                                <h4>No Events Available</h4>
                              
                           @endif
                      
              </div>
          </div>
          <!-- End fluid width widget -->
  </div>
  <div class="panel panel-default col-xs-12 col-sm-12">
        <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingTwo">
            <h3 class="panel-title">  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
  <span class="glyphicon glyphicon-calendar"></span> 
                Completed Events <span class="badge"></span></a>
            </h3>
        </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body"  id="user_scroll">
            <ul class="media-list">
                 @if(count($completedevents)>0)
                  @foreach($completedevents as $completed)
                  <ul class="media-list">
                      @php
                          $pieces = explode(' ',$completed->StartDateTime);
                          $date = $pieces[0];
                          $slices = explode('-',$date);
                          $year = $slices[0];
                          $month = $slices[1];
                          $day = $slices[2];
                          $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',07=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
                          @endphp
                      <li class="media">
                          <div class="media-left">
                              <div class="panel panel-default text-center date">
                                  <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                      <span class="panel-title strong">
                                         {{$months[(int)$month]}}
                                      </span>
                                  </div>
                                  <div class="panel-body day text-default" style="color:#46A6EA">
                                     {{$day}}
                                  </div>
                              </div>
                          </div>
                            <div class="media-body event-name" style="text-align: left;">
                              <h4 class="media-heading">
                                  {{$completed->EventName}}
                              </h4>
                                {{ substr($completed->Description,0,150)}}
                            </div>
                          <div class="media-right">
                          <a href="{{url('editevent/'.$completed->EventId)}}" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="{{url('event/'.$completed->ShortName)}}" class="icon-block"><i class="fa fa-eye" style="color:  #46A6EA;"  title="View"></i></a>
                              </p>
                          </div>
                      </li>
                  </ul>
                   @endforeach
                                             @else
                           
                                <h4>No Events Available</h4>
                              
                           @endif

                 
        </div>
    </div>
    <!-- End fluid width widget -->
  </div>
  </div>
  </div>
<div class="col-xs-12 col-sm-6">
  <!-- /panel -->
<div class="panel panel-default magic-element isotope-item widgets" style="margin-top:11px;">
  <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
    <h4 class="pb-title" style="padding:5px">My Events</h4>
  </div>
  <div class="panel-body">
    <div class="table table-responsive" id="user_scroll">
   <table class="table table-striped">
   <thead>
     <tr>
       <th>Event Name</th>
       <th>Schedule</th>
       <th>Settings</th>
       <th>Venue Approval</th>
     </tr>
   </thead>
   @foreach($myevents as $events)
   <tbody>
     @if($events->ApproveStatus == 'Pending')
     <tr>
       <td>{{$events->EventName}}</td>
       <td>{{$events->StartDateTime}}</td>
       <td>
   <div class="dropdown">
 <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
 <span class="caret"></span></i>
 <ul class="dropdown-menu" style="margin-left:-58px;">
   <li><a href="{{url('inviteparticipants/'.$events->EventId)}}"><i class="fa fa-check"> Invite</i></a></li>
   <li><a href="{{url('editevent/'.$events->EventId)}}"><i class="fa fa-pencil"> Edit</i></a></li>
   <li><a href="{{url('resultentry')}}"><i class="fa fa-list">  Results Entry</i></a></li>
   <li><a href="#"><i class="fa fa-close"> Cancel</i></a></li>
 </ul>
</div>
</td>
<td class="glyphicon glyphicon-remove-circle" style="color:#d9534f">Pending</td>
     </tr>
@else
<tr>
 <td>{{$events->EventName}}</td>
 <td>{{$events->StartDateTime}}</td>
 <td>
<div class="dropdown">
<i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
<span class="caret"></span></i>
<ul class="dropdown-menu" style="margin-left:-58px;">
<li><a href="{{url('inviteparticipants/'.$events->EventId)}}"><i class="fa fa-check"> Invite</i></a></li>
<li><a href="{{url('editevent/'.$events->EventId)}}"><i class="fa fa-pencil"> Edit</i></a></li>
<li><a href="{{url('resultentry')}}"><i class="fa fa-list">  Results Entry</i></a></li>
<li><a href="#"><i class="fa fa-close"> Cancel</i></a></li>
</ul>
</div>
</td>
<td class="glyphicon glyphicon-ok-circle" style=color:#46A6EA>Accepted</td>
</tr>
@endif
   </tbody>
   @endforeach
 </table>
</div>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-6">
  <div class="panel-group" id="accordionone" role="tablist" aria-multiselectable="true">
       <div class="panel panel-default active col-md-12">
                    <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingfive">
                        <h3 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordionone" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                            Pending Requests</a>
                        </h3>
                    </div>
                    <div id="collapsefive" class="panel-collapse collapse in"  role="tabpanel" aria-labelledby="headingfive">
                    <div class="panel-body" id="user_scroll">
                        <ul class="media-list">
                          @if(count($eventinvites)>0)
                          @foreach($eventinvites as $event)
                          <li class="media">
                              <div class="media-left">
                                @if($event->Image == "NA")
                                <img src="{{url('public/images/profile.png')}}" class="img-circle" width="65px" height="65px">
                                @else
                                <img src="{{url($event->Image)}}" class="img-circle" width="65px" height="65px">
                                @endif
         
                              </div>
                              <div class="media-body">
                                <p><b> {{$event->UserName}}</b></p>

                                                                    <p>
                                                                    Request to Subscribe an event
                                                                    </p>

                              </div>
                              <div class="media-right">
                                  <a href="{{url('/acceptevent/'.$event->EventId.'/event')}}"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
                                  <a href="{{url('/rejectevent/'.$event->EventId.'/event')}}"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
                              </div>
                          </li>
                        @endforeach
                          @else
                           
                                <h4>No Pending Requests</h4>
                              
                           @endif
                        </ul>
                        
                         </div>

<br><br>
                </div>
                <!-- End fluid width widget -->
  </div>
<div class="panel panel-default col-xs-12 col-sm-12">
            <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingsix">
                <h3 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionone" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                    Completed Requests</a>
                </h3>
            </div>
                <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
            <div class="panel-body"  id="user_scroll">
                <ul class="media-list">
                  @if(count($completedrequests)>0)
                  @foreach($completedrequests as $completed)
                  <li class="media">
                      <div class="media-left">
                        <img src="{{url('public/images/sravan.jpeg')}}" class="img-circle" width="65px" height="65px">
                      </div>
                      <div class="media-body">
                        <p><b> {{$completed->UserName}}</b></p>
                      
                        <p>
                       Request to Subscribe an event
                        </p>
                       
                      </div>
                     <div class="media-right">
                                @if($completed->Status == "accepted")
                                   <i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i>
                                   @else
                                  <i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i>
                                  @endif
                              </div>
                  </li>
                 @endforeach
                 @else
                          
                                <h4>No Completed Requests</h4>
                            
                           @endif
                </ul>

            </div><br><br>
        </div>
  </div>
  </div>    <!-- End fluid width widget -->
</div>
<div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                     <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title" style="padding:5px">Notifications</h4>
                                </div>
                                <ul  id="user_scroll">
                                    @if(count($notifications)>0)
                                    @foreach($notifications as $notification)
                               <li class="media">
                              <div class="media-left">
                                @if($notification->ImagePath == "NA")
                                <img src="{{url('public/images/profile.png')}}" class="img-circle" width="65px" height="65px">
                                @else
                                <img src="{{url($notification->ImagePath)}}" class="img-circle" width="65px" height="65px">
                                @endif
         
                              </div>
                              <div class="media-body">
                                <p><b> {{$notification->EventName}}</b></p>
                                       <p>You Got Event Invitation,Please <a href="{{url('acceptevent/'.$notification->EventId.'/'.$notification->ParticipantId)}}" style="color:#46A6EA">click here</a> to accept</p>

                              </div>
                            </li>
                                  @endforeach
                                  @else
                                  <h3>No Notifications</h3>
                                  @endif
                                  </ul>


  </div>
</div> 
<div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                          <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title"style="padding:5px">Flagged</h4>
                                </div>
                          <div class="panel-body">
                           @if(count($flags)>0)   
                            <div class="table table-responsive" id="user_scroll">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Event Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                              </tr>
                            </thead>
                            
                             @foreach($flags as $flag)
                            <tbody>
                              <tr>
                                <td>{{$flag->EventName}}</td>
                                <td>{{$flag->StartDateTime}}</td>
                                <td>{{$flag->EndDateTime}}</td>
                                </tr>
                             
                        
                            </tbody>
                            @endforeach
                            @else
                            <h4>No flaged Events</h4>
                            @endif
                          </table>
                        </div>


</div>
  </div>
</div>
</div>
<!-- /panel -->
</div>
<!-- Dash board code ends here -->
  @endsection