 @extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- kin information code starts here -->
@foreach($clubs as $club)
  <div class="container" id="main-code">
     <div class="col-xs-12 col-sm-6 col-md-3 kin_photo">
     <div class="fb-profile"  style="margin-top:13%">
    <img class="thumbnail profile_image" id="image_{{ $club->ClubId }}" src="{{ url('public/images/club.jpg') }}"/>     <div class="fb-profile-text text-center">
         <h3>{{$club->ClubName}}</h3>
          <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:{{$club->Country}}</p>
</div>
</div>
</div>
 <div class="col-xs-12 col-sm-6 col-md-9 kin_info">
<form class="form-horizontal kin_infor">
          <div class="well" style="background:#fff">
          <div class="row">
        <div class="col xs-12 col-sm-12 col-md-offset-2 col-md-4 col-lg-offset-2 col-lg-4">
              <div>
                  <h4 class="field_names">Club Type</h4></div>
         <p>{{$club->ClubType}}</p>
           <div>
                  <h4 class="field_names">Short Name</h4></div>
              <p>{{$club->ShortName}}</p>
                 <div>
                    <h4 class="field_names">Address</h4></div>
                 <p>{{$club->AddressLine1}}</p>
                 <div>
                   <h4 class="field_names">City</h4></div>
                 <p>{{$club->City}}</p>
                 <div>
                   <h4 class="field_names">Post code</h4></div>
                 <p>{{$club->PostCode}}</p>
                 <div>
                   <h4 class="field_names">Town</h4></div>
                 <p>{{$club->County}}</p>
                 <div>
                   <h4 class="field_names">Mobile</h4></div>
                 <p>{{$club->MobilePhone}}</p>
               </div>
                 <div class="col xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div>
                   <h4 class="field_names">Email</h4></div>
                 <p>{{$club->Email}}</p>
                 <div>
                   <h4 class="field_names">Web</h4></div>
                 <p>{{$club->Website}}</p>
                 <div>
                   <h4 class="field_names">Facebook</h4></div>
                 <p>{{$club->Facebook}}</p>
                 <div>
                   <h4 class="field_names">Google +</h4></div>
                 <p>{{$club->GooglePlus}}</p>
                 <div>
                   <h4 class="field_names">Twitter</h4></div>
                 <p>{{$club->Twitter}}</p>
                 <div>
                   <h4 class="field_names">Others</h4></div>
                 <p>{{$club->Others}}</p>
               </div>

  </div>
  <div class="col-sm-offset-2">

    <h4 class="field_names">Description</h4></div>
  <p class=" col-sm-offset-2">{{$club->Description}}</p>

</div>

</div>
<center>
@if(count($bridgemembers)>0)
@if($bridgemembers[0]->ApproveStatus == 'pending')
<button class="btn btn-primary"><a href="{{url('/club/'.$club->ShortName)}}">Request Sent</a></button>
@elseif($bridgemembers[0]->ApproveStatus == 'accepted')
 <button class="btn btn-primary"><a href="{{url('/club/'.$club->ShortName)}}">Accepted</a></button>
@elseif($bridgemembers[0]->ApproveStatus == 'rejected')
 <button class="btn btn-primary"><a href="{{url('/club/'.$club->ShortName)}}">Rejected</a></button>
@endif
@else
 <button class="btn btn-primary"><a href="{{url('/club/'.$club->ShortName.'/join')}}">Join Now</a></button>
@endif
</div>
@endforeach
</div>
<!-- kin information code ends here -->
@endsection