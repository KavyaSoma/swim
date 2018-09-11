@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin-left:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <div class="container">
  <h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Venue</h5>
      <div class="row" style="border:1px solid #eee">
             <div class="board">
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                 <div class="board-inner  iconlist">
                 <ul class="nav nav-tabs nav_info" id="myTab">
                 <div class="liner"></div>
                  <li>
                  <a href="" title="Venue Summary">
                   <span class="round-tabs">
                           <i class="fa fa-list"></i>
                   </span>
               </a></li>

               <li><a href=""  title="Pool Information">
                  <span class="round-tabs">
                      <i class="fa fa-info"></i>
                  </span>
        </a>
              </li>
              <li><a href="" title="Address & Contact">
                  <span class="round-tabs">
                       <i class="fa fa-phone"></i>
                  </span> </a>
                  </li>

                  <li><a href="" title="Open hours & Facilities">
                      <span class="round-tabs">
                           <i class="fa fa-clock-o"></i>
                      </span>
                  </a></li>
                  <li><a href="" title="Web site & Social Links">
                      <span class="round-tabs">
                           <i class="fa fa-share-alt"></i>
                      </span>
                  </a></li>

                  <li  class="active"><a href="" title="Confirm Venue">
                      <span class="round-tabs">
                           <i class="fa fa-check"></i>
                      </span> </a>
                  </li>

                  </ul></div>

    <div class="tab-pane fade in active" id="venueconfirm">
     
<div class="table-responsive">
  <table class="table">
    <thead>
    <tr>
      <th>Pool Name</th>
      <th>Pool Area</th>
      <th>Length</th>
      <th>Width</th>
      <th>Deep End</th>
      <th>Shallow End</th>
    </tr>
  </thead>
   @foreach($pool_details as $pool)
    <tr>
      <td>{{$pool->PoolName}}</td>
      <td>{{$pool->Area}}</td>
      <td>{{$pool->Length}}</td>
      <td>{{$pool->Width}}</td>
      <td>{{$pool->MaximumDepth}}</td>
      <td>{{$pool->MinimumDepth}}</td>
    </tr>
    @endforeach
    <tr>
   
  </table>
</div>

<h5 style="color:#46A6EA"><b>Venue Name</b></h5>
@foreach($facilities as $facility)
<p>{{$facility->VenueName}}</p>
@endforeach
<h5 style="color:#46A6EA"><b>Pool Description</b></h5>
@foreach($pool_details as $pool)
<p>{{$pool->SpecialRequirements}}</p>
@endforeach

<h5 style="color:#46A6EA"><b>Open Hours</b></h5>
@foreach($timings as $time)
<p>{{$time->Day}}({{$time->OpeningHours}}-{{$time->ClosingHours}})<br>
  </p>
  @endforeach
<h5 style="color:#46A6EA"><b>Address</b></h5>
@foreach($venue_address as $address)
<p>{{$address->AddressLine1}}<br>Post Code: {{$address->PostCode}}<br>{{$address->City}},{{$address->County}},{{$address->Country}}</p>
@endforeach
<h5 style="color:#46A6EA"><b>Contact</b></h5>
@foreach($venue_contact as $contact)
<p>Mobile:{{$contact->Phone}}<br>Email:{{$contact->Email}}</p>
@endforeach
@if(count($facilities)>0)
@foreach($facilities as $facility)
<h5 style="color:#46A6EA"><b>Facilities</b></h5>
@if($facility->VisitingGallery == "yes")
<p>VisitingGallery</p>
@endif
@if($facility->Shower == "yes")
<p>Shower</p>
@endif
@if($facility->Gym == "yes")
<p>Gym</p>
@endif
@if($facility->Teachers == "yes")
<p>Teachers</p>
@endif
@if($facility->ParaSwimmingFacilities == "yes")
<p>ParaSwimmingFacilities</p>
@endif
@if($facility->LadiesOnlySwimming == "yes")
<p>LadiesOnlySwimming</p>
@endif
@if($facility-> Toilets == "yes")
<p> Toilets</p>
@endif
@if($facility->Diving == "yes")
<p>Diving</p>
@endif
@if($facility->PrivateHire == "yes")
<p>PrivateHire</p>
@endif
@if($facility->Parking == "yes")
<p>Parking</p>
@endif
@if($facility->SwimForKids == "yes")
<p>SwimForKids</p>
@endif
@endforeach
@endif
<br>
<hr>
<form method="post" action="{{url('confirmvenue/'.$venue_id)}}">
  {{csrf_field()}}
<center>
       
      <button class="btn btn-primary">Submit</button>
    </form>
</center>
   </div>
</div>
</div>
</div>

</div>
</div>
@endsection