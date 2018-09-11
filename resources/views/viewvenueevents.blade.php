@extends('layouts.calendarmain')
@section('content')
<div class="row1">
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content') !!}
    </div>
@endif
    <!-- venue info code starts here -->
<div class="container" id="main-code">
  <div class="row" id="venuepreview_tabs">
    @if(count($venues)>0)
<h3 class="col-sm-8 mob-none">{{$venues[0]->VenueName}}</h3>
<h4 class="col-sm-8 desk-none tab-none mob-block">{{$venues[0]->VenueName}}</h4>
<h3 class="col-sm-4">
               <center>
       @if(count($bridgemembers)>0)
        @if($bridgemembers[0]->ApproveStatus == 'pending')
        <a href="{{url('/venue/'.$venues[0]->ShortName)}}"><button class="btn btn-primary mybtn">Request Sent</button></a>
        @elseif($bridgemembers[0]->ApproveStatus == 'accepted')
        <a href="{{url('/venue/'.$venues[0]->ShortName)}}"><button class="btn btn-primary mybtn">Accepted</button></a>
        @elseif($bridgemembers[0]->ApproveStatus == 'rejected')
        <a href="{{url('/venue/'.$venues[0]->ShortName)}}"><button class="btn btn-primary mybtn">Rejected</button></a>
         @endif
        @else
        <a href="{{url('/venue/'.$venues[0]->ShortName.'/join')}}"><button class="btn btn-primary mybtn">Join Now</button></a>

        @endif
        <a href="{{url('addevent')}}"><button class="btn btn-primary mybtn">Book An Event</button></a>

    </h3>
  <div class="row" id="venuepreview_tabs">
    <div class="col-sm-12">


	   @include('venuesidebar')
    <div class="col-sm-8">

        <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Pool Details</a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Events</a></li>

		</ul>
		<ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>

		</ul>
      @endif


      <div class="tab-content preview_details">
           <div id="venuepreview-events" class="tab-pane fade in active">
           <form class="form-horizontal">
             <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="row">
                 <div class="col-sm-12 col-xs-12">
                   <div class="tab-content preview_details">

                        </div>
        </div>
      </div>  <div class="col-sm-6 col-xs-12" style="margin-top:25px">



      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default active col-md-12 col-xs-12">
              <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;*background:#46A6EA;color:#fff" role="tab" id="headingOne">
                  <h3 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: #46a6ea;" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                      <span class="glyphicon glyphicon-calendar"></span>&nbsp;
                      Upcoming Events <span class="badge"></span></a><br>
                  </h3>
              </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                <div class="panel-body" id="user_scroll">
                           @if(count($upcomingevents)>0)

                      <ul class="media-list">
                        @foreach($upcomingevents as $event)
                        @php
                        $pieces = explode(' ',$event->StartDateTime);
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
                                 {{$event->EventName}}
                              </h4>
                                  {{ substr($event->Description,0,150)}}
                            </div>
                          <div class="media-right">
                          <a href="http://localhost/nswimmiq/editevent/374" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="http://localhost/nswimmiq/event/ssssss" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;" title="Share"></i></a>
                              </p>
                          </div>
                      </li>
                         @endforeach
                     </ul>

                      @else
                        <h6>No Upcoming Events</h6>
                      @endif

              </div>
          </div>
          <!-- End fluid width widget -->
  </div>
  <div class="panel panel-default col-xs-12 col-sm-12">
        <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;*background:#46A6EA;color:#46A6EA" role="tab" id="headingTwo">
            <h3 class="panel-title">  <a class="" role="button" data-toggle="collapse" style="color: #46a6ea;" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
  <span class="glyphicon glyphicon-calendar"></span>&nbsp;
                Completed Events <span class="badge"></span></a>
            </h3>
        </div>
            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="true" >
        <div class="panel-body" id="user_scroll">
          @if(count($completedevents)>0)
            <ul class="media-list">
            <ul class="media-list">
                            @foreach($completedevents as $completed)
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
                          <a href="http://localhost/nswimmiq/editevent/351" class="icon-block"><i class="fa fa-edit" style="color: #46a6ea;" title="Edit"></i></a>
                              <p>
                          <a href="http://localhost/nswimmiq/event/festival" class="icon-block"><i class="fa fa-eye" style="color:  #46A6EA;" title="View"></i></a>
                              </p>
                          </div>
                      </li>
                      @endforeach

                  </ul>
                  @else
                    <h6>No Completed Events</h6>
                  @endif

                                     <ul class="media-list">
                                            <li class="media">
                          <div class="media-left">
                              <div class="panel panel-default text-center date">
                                  <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                      <span class="panel-title strong">
                                         Jul
                                      </span>
                                  </div>
                                  <div class="panel-body day text-default" style="color:#46A6EA">
                                     07
                                  </div>
                              </div>
                          </div>
                            <div class="media-body event-name" style="text-align: left;">
                              <h4 class="media-heading">
                                  booking
                              </h4>
                                 description of new swim event 106
                            </div>
                          <div class="media-right">
                          <a href="http://localhost/nswimmiq/editevent/352" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="http://localhost/nswimmiq/event/booking" class="icon-block"><i class="fa fa-eye" style="color:  #46A6EA;" title="View"></i></a>
                              </p>
                          </div>
                      </li>
                  </ul> </ul>
				  </div>
    </div>
    <!-- End fluid width widget -->
  </div>
  </div>
  </div>
              <div class="col-sm-6 col-xs-12">
<div class="box box-primary" style="margin-top:10%">
<div class="box-body no-padding">
   {!! $calendar->calendar() !!}
</div>
 </div>
</div>
          </div><br>
           </div>
           </div>
    <br><br>
    </div>

    </div>
  </div>
</div></div>
@endsection
