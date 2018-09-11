@extends('layouts.main')
@section('content')
<div class="row1">
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
@endif
</div>
    <!-- venue info code starts here -->
<div class="container" id="main-code">
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
	   <div class="col-sm-7 col-xs-12">
        <ul class="nav nav-tabs preview_tabs mob-none">
          <li class="active"><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Pool Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Events</a></li>

        </ul>
	    <ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li class="active"><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>

        </ul>
       <div class="tab-content preview_details">
    <div id="venuepreview-basic" class="tab-pane fade in active">
          <form class="form-horizontal">
            <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
            <br>
              <p>{{$venues[0]->Description}}</p><hr></div>
         </form>
       </div>
	   <div class="col-sm-6 col-xs-6">
					<form class="form-horizontal">
                 <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div>
                        <h4 class="field_names"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Address</h4></div>
						<p style="line-height:10px">Vonkdoth</p>
						<p style="line-height:10px">Suryapet Road</p>
						<p style="line-height:10px">Jangoan</p>

                     <div>
                       <h4 class="field_names">City</h4></div>
                     <p>Jangoan</p>
                     <div>
                        <h4 class="field_names">Post Code</h4></div>
                     <p>506147</p>
                     <div>
                        <h4 class="field_names">State</h4></div>
                     <p>Telangana</p>
                  <div>
                        <h4 class="field_names">Country</h4></div>
                     <p>India</p>
                   </div>
                 </form>
	   </div>
	   <div class="col-sm-6 col-xs-6" style="overflow-x: auto;">
		<form class="form-horizontal">
                           <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div>
                       <h4 class="field_names"><i class="fa fa-phone" aria-hidden="true"></i> Contact</h4></div>
                     <p>{{$venues[0]->Phone}}</p>
                     <div>
                        <h4 class="field_names">Mobile</h4></div>
                     <p>{{$venues[0]->Mobile}}</p>
                     <div>
                        <h4 class="field_names">Email</h4></div>
                     <p>{{$venues[0]->Email}}</p>
                      <div>
                    <h4 class="field_names">Link 1</h4></div>
                     <p><a href="#" style="color: #333">{{$venues[0]->Website}}</a></p>
                     <div>
                    <h4 class="field_names">Link 2</h4></div>
                     <p><a href="#" style="color: #333">{{$venues[0]->Website2}}NA</a></p><br>

    </div>
    </form>
	   </div>
	   <div class="col-sm-12">

	   <div class="row">
	   <h4 style="color:#46A6EA">Facilities</h4>
        @if($venues[0]->ParaSwimmingFacilities == "yes")
        <div class="col-xs-2 col-sm-1">
      <img src="{{url('public/images/paraswimming.jpg')}}" height="30px" width="30px" alt="paraswimming" title="Paraswimming"/>
        </div>
        @endif
        @if($venues[0]->Parking == "yes")
      <div class="col-xs-2 col-sm-1">
          <img src="{{url('public/images/parking.jpg')}}" height="30px" width="30px" alt="parking" title="Parking"/>
      </div>
      @endif
      @if($venues[0]->LadiesOnlySwimming == 'yes')
        <div class="col-xs-2 col-sm-1">
          <img src="{{url('public/images/swimpool.jpg')}}" height="30px" width="30px" alt="pool" title="Ladies Only Swimming"/>
         </div>
         @endif
         @if($venues[0]->Shower == "yes")
          <div class="col-xs-2 col-sm-1">
              <img src="{{url('public/images/shower.png')}}" height="30px" width="30px" alt="shower" title="Shower"/>
           </div>
           @endif
           @if($venues[0]->PrivateHire == "yes")
            <div class="col-xs-2 col-sm-1">
                  <img src="{{url('public/images/privatehire.png')}}" height="30px" width="30px" alt="food" title="Food Court"/>
             </div>
             @endif
			 @if($venues[0]->Gym == "yes")
               <div class="col-xs-2 col-sm-1">
                  <img src="{{url('public/images/gym.jpg')}}" height="30px" width="30px" alt="gym" title="Gym"/>
                </div>
                @endif
                @if($venues[0]->Diving == "yes")
                  <div class="col-xs-2 col-sm-1">
                    <img src="{{url('public/images/diving.png')}}"  height="30px" width="30px"  alt="diving" title="Diving"/>
                  </div>
                  @endif
                  @if($venues[0]->SwimForKids = "yes")
                    <div class="col-xs-2 col-sm-1">
                      <img src="{{url('public/images/kidszone.png')}}"  height="30px" width="30px"  alt="Kids Zone" title="Kids Zone"/>
                    </div>
                    @endif
                    @if($venues[0]->Teachers == "yes")
                      <div class="col-xs-2 col-sm-1">
                        <img src="{{url('public/images/instructors.png')}}"  height="30px" width="30px"  alt="Instructors" title="instructors"/>
                      </div>
                      @endif
                      @if($venues[0]->Toilets == "yes")
                      <div class="col-xs-2 col-sm-1">
                        <img src="{{url('public/images/instructors.png')}}"  height="30px" width="30px"  alt="Instructors" title="instructors"/>
                      </div>
                      @endif
				@if($venues[0]->VisitingGallery == "yes")
				<div class="col-xs-2 col-sm-1">
                  <img src="{{url('public/images/VisitingGallery.png')}}" height="30px" width="30px" alt="gym" title="Gym"/>
                </div>
                @endif
				@if($venues[0]->LadiesOnlySwimTimes == "yes")
                 <div class="col-xs-2 col-sm-1">
                  <img src="{{url('public/images/ladiesonlyswimmtime.png')}}" height="30px" width="30px" alt="gym" title="Gym"/>
                </div>
                @endif
           </div>
	   </div>
       </div>
    <br><br>
    @endif
    </div>
   </div>

    </div>
  </div>
</div>
@endsection
