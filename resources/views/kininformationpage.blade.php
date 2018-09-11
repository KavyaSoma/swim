@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- kin information code starts here -->
  <div class="container">
     <div class="col-xs-12 col-sm-6 col-md-3" id=kin_photo>
     <div class="fb-profile"  style="margin-top:13%">
      @foreach($participants as $participant)
@if($participant->Image == "NA")
 <img class="thumbnail profile_image"  src="{{url('images/sravan.jpeg')}}" alt="Profile image"/>
@else
  <img class="thumbnail profile_image"  src="images/sravan.jpeg" alt="Profile image"/>
     @endif
     <div class="fb-profile-text text-center">
         <h3>{{$participant->ParticipantName}}</h3>
         <p class="text-center">{{$participant->Relationship}}</p>
            <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:UK</p>
</div>
</div>
</div>
 <div class="col-xs-12 col-sm-6 col-md-9" id="kin_info">
<form class="form-horizontal kin_info">

        <div class="well" style="background:#fff">
          <div class="row">
        <div class="col xs-12 col-sm-12 col-md-offset-2 col-md-4 col-lg-offset-2 col-lg-4">
              <div>
                  <h4 class="field_names">Date Of Birth</h4></div>
         <p>{{$participant->DateofBirth}}</p>
              <div>
                  <h4 class="field_names">Gender</h4></div>
              <p>{{$participant->Gender}}</p>
                 <div>
                    <h4 class="field_names">Height</h4></div>
                 <p>{{$participant->Height}}</p>
                 <div>
                   <h4 class="field_names">Weight</h4></div>
                 <p>{{$participant->Weight}}</p>
               </div>
                 <div class="col xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div>
                   <h4 class="field_names">Is Disabled</h4></div>
                 <p>{{$participant->IsDisabled}}</p>
                 <div>
                   <h4 class="field_names">Contact Name</h4></div>
                 <p>{{$participant->EmergencyContactName}}</p>
                 <div>
                   <h4 class="field_names">Contact Number</h4></div>
                 <p>{{$participant->EmergencyContactNumber}}</p>
                 <div>
                   <h4 class="field_names">Contact Address</h4></div>
                 <p>{{$participant->EmergencyContactAddress}}</p>

 </div>
</div>
</div>
<center><button class="btn btn-primary"><a href="{{url('editkin/'.$participant->ParticipantId)}}">Edit</a></button><br><br>
  @endforeach
</div>
</div>
<!-- kin information code ends here -->
@endsection