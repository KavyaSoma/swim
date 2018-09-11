 @extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
  <div class="container" id="main-code">
  <div class="row" id="eventpreview_tabs">
    <div class="col-sm-8">
      @if ( count($events) > 0 )
        <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Sub Event Details</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Schedule</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Venue</a></li>
          
      </ul>
	  <ul class="nav nav-tabs preview_tabs mob-none desk-none mob-block tab-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> </a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> </a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> </a></li>
          
      </ul>
      @endif
      <div class="tab-content preview_details">
         <div id="eventpreview-subevents" class="tab-pane fade in active">
          <div class="table table-responsive" style="margin-top: 3%">
         <table class="table table-bordered">
<thead>
<tr>
<th>Sub Event Name</th>
<th>Swim Style</th>
<th>Course</th>
<th>Maximum Participants</th>
<th>Minimum Participants</th>
<th>Maximum Age</th>
<th>Minimum Age</th>
<th>Special Instructions</th>
</tr>
</thead>
@foreach($subevents as $subevent)
<tbody>
<tr>
<td>{{$subevent->SubEventName}}</td>
<td>{{$subevent->SwimStyle}}</td>
<td>{{$subevent->Course}}</td>
<td>{{$subevent->MaxParticipants}}</td>
<td>{{$subevent->MinParticipants}}</td>
<td>{{$subevent->MaximumAge}}</td>
<td>{{$subevent->MinimumAge}}</td>
<td>{{$subevent->SpecialInstructions}}</td>
</tr>
</tbody>
@endforeach
</table>
</div>
         </div>
    </div>
  </div>
      @include('eventsidebar')
 </div></div></div>
@endsection