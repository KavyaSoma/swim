@extends('layouts.main')
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
    <div class="col-sm-8">
     @if(count($venues)>0)
        <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Pool Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i>Events</a></li>
          <li class="active"><a  href="{{url('venue/'.$venues[0]->ShortName.'/venueaddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuecontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
        </ul>
      <ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>
          <li  class="active"><a  href="{{url('venue/'.$venues[0]->ShortName.'/venueaddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuecontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i></a></li>
        </ul>
      @endif
      <div class="tab-content preview_details">
         <div id="venuepreview-address" class="tab-pane fade in active">
          @foreach($address as $add)
               <form class="form-horizontal">
                 <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div>
                        <h4 class="field_names">Address</h4></div>
                     <p>{{$add->AddressLine1}},{{$add->AddressLine2}},{{$add->AddressLine3}}.</p><hr>
                     <div>
                       <h4 class="field_names">City</h4></div>
                     <p>{{$add->City}}x</p><hr>
                     <div>
                        <h4 class="field_names">Post Code</h4></div>
                     <p> {{$add->PostCode}}</p><hr>
                     <div>
                        <h4 class="field_names">Town</h4></div>
                     <p> {{$add->County}}</p><hr>
                  <div>
                        <h4 class="field_names">Country</h4></div>
                     <p> {{$add->Country}}</p>
                   </div>
                 </form>
                 @endforeach
               </div>
               </div>
    <br><br>
    </div>
    @include('venuesidebar')
    </div>
  </div>
</div>
@endsection