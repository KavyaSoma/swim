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
      @if (count($events) > 0)
        <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Sub Event Details</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Schedule</a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa  fa-map-marker" aria-hidden="true" id="info_fa"></i> Venue</a></li>
      </ul>
	  <ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a href="{{url('event/'.$events[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/subevent')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventschedule')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('event/'.$events[0]->ShortName.'/eventcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('event/'.$events[0]->ShortName.'/eventvenue')}}"> <i class="fa  fa-map-marker" aria-hidden="true" id="info_fa"></i></a></li>
      </ul>
      @endif
      @if (count($eventvenue) > 0)
      <div id="eventpreview-venue" class="tab-pane fade in active">
        <div class="table table-responsive" style="margin-top: 3%">
         <table class="table table-bordered">
<thead>
<tr>
<th>Venue Name</th>
<th>Address</th>
<th>City</th>
<th>Post Code</th>
</tr>
</thead>
@foreach($eventvenue as $event)
<tbody>
<tr>
<td>{{$event->VenueName}}</td>
<td>{{$event->AddressLine1}},{{$event->AddressLine2}},{[$event->AddressLine3}}</td>
<td>{{$event->City}}</td>
<td>{{$event->PostCode}}</td>
</tr>
</tbody>
@endforeach
</table>
</div>
   </div>
@else
<h4>No Data Available</h4>
@endif
</div>
   @include('eventsidebar')
</div></div></div>
@endsection