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
          <li><a  href="{{url('venue/'.$venues[0]->ShortName.'/venueaddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venuecontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
		</ul>
		<ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a  href="{{url('venue/'.$venues[0]->ShortName.'/venueaddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venuecontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i></a></li>
		</ul>
       <div class="tab-content preview_details">
      <div id="venuepreview-contact" class="tab-pane fade in active">
                         <form class="form-horizontal">
                           <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div>
                       <h4 class="field_names">Contact</h4></div>
                     <p>{{$venues[0]->Phone}}</p><hr>
                     <div>
                        <h4 class="field_names">Mobile</h4></div>
                     <p>{{$venues[0]->Mobile}}</p><hr>
                     <div>
                        <h4 class="field_names">Email</h4></div>
                     <p>{{$venues[0]->Email}}</p><hr>
                      <div>
                    <h4 class="field_names">Link 1</h4></div>
                     <p><a href="#" style="color: #333">{{$venues[0]->Website}}</a></p><hr>
                     <div>
                    <h4 class="field_names">Link 2</h4></div>
                     <p><a href="#" style="color: #333">{{$venues[0]->Website2}}</a></p><hr>
                          <div>
                    <h4 class="field_names">Facebook</h4></div>
                  <p>{{$venues[0]->Facebook}}</p><hr>
                  <div>
                     <h4 class="field_names">Twitter</h4></div>
                  <p>{{$venues[0]->Twitter}}</p><hr>
                  <div>
                     <h4 class="field_names">Google+</h4></div>
                  <p>{{$venues[0]->GooglePlus}}</p>
    </div>
    </form>
    </div>
     </div>
    <br><br>
    @endif
    </div>
    @include('venuesidebar')
    </div>
  </div>
</div>
@endsection