@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- instructor preview code starts here -->
   <div class="container" id="main-code">
     <div class="fb-profile">
@foreach($instructors as $instructor)
  <div class="container" style="margin-top:20px;background-color:#fff;padding:10px">
      <div class="col-sm-9">
      
    <ul class="nav nav-tabs preview_tabs mob-none">
        <li><a href="{{url('instructor/'.$instructor->ShortName)}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Events</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructoraddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorqualification')}}"> <i class="fa fa-globe" aria-hidden="true" id="info_fa"></i> Qualification</a></li>
         <li class="active"><a href="{{url('instructor/'.$instructor->ShortName.'/instructorcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
            <li><a href="{{url('instructor/'.$instructor->ShortName.'/bookinstructor')}}"> Book Instructor</a></li>
   </ul>
 <ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
        <li><a href="{{url('instructor/'.$instructor->ShortName)}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructoraddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i></a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorqualification')}}"> <i class="fa fa-globe" aria-hidden="true" id="info_fa"></i></a></li>
         <li class="active"><a href="{{url('instructor/'.$instructor->ShortName.'/instructorcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i></a></li>
            <li><a href="{{url('instructor/'.$instructor->ShortName.'/bookinstructor')}}"></a></li>
   </ul>
      <div class="tab-content preview_details">
<div id="instructorpreview-contact" class="tab-pane fade in active">
     <form class="form-horizontal">
       <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
    <div>
   <h4 class="field_names">Mobile</h4></div>
   <p>Day Time : {{$instructor->DayTimePhone}}<br>
      Evening Phone : {{$instructor->EveningPhone}}</p><hr>
   <div>
   <h4 class="field_names">Email</h4></div>
   <p>{{$instructor->Email}}</p><hr>
   <div>
   <h4 class="field_names">Web</h4></div>
   <p>{{$instructor->Website}}</p><hr>
   <div>
   <h4 class="field_names">Facebook</h4></div>
   <p>{{$instructor->Facebook}}</p><hr>
   <div>
   <h4 class="field_names">Twitter</h4></div>
   <p>{{$instructor->Twitter}}</p><hr>
  
 </div>
</div>
 </div>
</div>
@include('instructorsidebar')
</div>
@endforeach
</div>
</div>
</div>
</div>
<!-- instructor preview code starts here -->
@endsection