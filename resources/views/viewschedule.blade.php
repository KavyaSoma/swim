@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- Event info code starts here -->
<div class="container" id="main-code">
  <div class="row" id="eventpreview_tabs">
    <div class="col-sm-8">
      @if ( count($events) > 0 )
        <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Sub Event Details</a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Schedule</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Venue</a></li>
      </ul>
	  <ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i></a></li>
      </ul>
      @endif
 <div id="eventpreview-schedule" class="tab-pane fade in active">
           <form class="form-horizontal">
             <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="row">
                 <div class="col-sm-12">
                   <div class="tab-content preview_details">
                        <div id="eventpreview-upcoming" class="tab-pane fade in active">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                             <div class="panel panel-default active col-md-12">
                                <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingOne">
                                <h3 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <span class="glyphicon glyphicon-calendar"></span> Upcoming Events</a>
                                </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in"  role="tabpanel" aria-labelledby="headingOne">
                                   <div class="panel-body">
                                    @if(count($upcomingevents)>0)
                                   @foreach($upcomingevents as $upcoming)
                          @php
                          $pieces = explode(' ',$upcoming->StartDateTime);
                          $date = $pieces[0];
                          $slices = explode('-',$date);
                          $year = $slices[0];
                          $month = $slices[1];
                          $day = $slices[2];
                          $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',07=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
                          @endphp
                                    <ul class="media-list">
                                      <li class="media">
                                        <div class="media-left">
                                          <div class="panel panel-default text-center date">
                                           
                                            <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                              <span class="panel-title strong">   {{$months[(int)$month]}}</span>
                                            </div>
                                            <div class="panel-body day text-default" style="color:#46A6EA">    {{$day}}
                                            </div>
                                            </div>
                                          </div>
                                          <div class="media-body">
                                            <h4 class="media-heading">
                                                         {{$upcoming->EventName}}
                                                          </h4>
                                                          <p>
                                                           {{ substr($upcoming->Description,0,150)}}
                                                          </p>
                                                      </div>

                                                  </li>
                                                 
                                              </ul>
                                              @endforeach
                                              @else
                                              <h1>No Events availabe</h1>
                                              @endif

                                              @if(count($upcomingevents)>0)
                                 <div class="text-center">
                                   <ul class="pagination">
                                {{ $upcomingevents->links() }}
                                 </ul>
                                 </div>
                                @endif
                                          </div>
                                      </div>
                                      <!-- End fluid width widget -->
                          </div>
                          <div class="panel panel-default col-md-12">
                                    <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingTwo">
                                        <h3 class="panel-title">  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="glyphicon glyphicon-calendar"></span> 
                                            Completed Events</a>
                                        </h3>
                                    </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                      @if(count($completedevents)>0)
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
                                        <ul class="media-list">
                                            <li class="media">
                                                <div class="media-left">
                                                    <div class="panel panel-default text-center date">
                                                        <div class="panel-heading month"  style="background:#ff6600;color:#fff">
                                                            <span class="panel-title strong">
                                                                {{$months[(int)$month]}}
                                                            </span>
                                                        </div>
                                                        <div class="panel-body day text-default" style="color:#46A6EA">
                                                            {{$day}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                          {{$completed->EventName}}
                                                    </h4>
                                                    <p>
                                                           {{ substr($completed->Description,0,150)}}
                                                    </p>
                                                </div>
                                            </li>
                                             </ul>
                                             @endforeach
                                             @else
                                              <h1>No Events availabe</h1>
                                              @endif

                                              @if(count($completedevents)>0)
                                 <div class="text-center">
                                   <ul class="pagination">
                                {{ $completedevents->links() }}
                                 </ul>
                                 </div>
                                @endif
                                      
                                    </div>
                                </div>
                                <!-- End fluid width widget -->
                          </div>
                          </div>
                         </div>
                        </div>
        </div>
      </div>
               
          </div><br>
       </div>
    </div>
    @include('eventsidebar')
 
</div></div></div>
@endsection