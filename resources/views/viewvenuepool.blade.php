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
	   <div class="col-sm-8 col-xs-12">

         <ul class="nav nav-tabs preview_tabs mob-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Pool Details</a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> Events</a></li>

		</ul>
		<ul class="nav nav-tabs preview_tabs desk-none mob-block tab-none">
          <li><a  href="{{url('venue/'.$venues[0]->ShortName)}}"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i></a></li>
          <li class="active"><a href="{{url('venue/'.$venues[0]->ShortName.'/venuepool')}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i></a></li>
          <li><a href="{{url('venue/'.$venues[0]->ShortName.'/venueevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i></a></li>

		</ul>
      @endif
      <div class="tab-content preview_details">
        <div id="venuepreview-pool" class="tab-pane fade in active">
         <div class="col-sm-12"   style="background:#fff;*border:1px solid #ddd;margin-top:30px">
           <div class="row" style="*margin-top:20px;">
             @if(count($pools)>0)
            @foreach($pools as $pool)
          <div class="panel panel-default  col-md-12">
                             <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#fff;color:#46A6EA"  role="tab">
                                 <h2 class="panel-title">
                                  {{$pool->PoolName}}</a>
                                 </h2>
                             </div>

                            <div class="panel-body">
								<div>
                                   <h4 class="field_names">Special Reuirements</h4>
                                </div>
                                   <p>{{$pool->SpecialRequirements}}</p>
                                <div class="col xs-12 col-sm-4">
                                  <div>
                                   <h4 class="field_names">Area</h4>
                                  </div>
                                   <p>{{$pool->Area}}</p>
                                  <div>
                                    <h4 class="field_names">Length</h4>
                                  </div>
                                    <p>{{$pool->Length}}</p>

                                 </div>
								 <div class="col xs-12 col-sm-3 col-sm-offset-3">
								 <img id="image_2" style="width:100%" src="{{url('public/images/poolimage.png')}}">
								 </div>
                            </div>
                         </div>
                         <!-- End fluid width widget -->
                      @endforeach
                      @else
          <h6>No Pools Available</p>
            @endif
             </div>
             @if(count($pools)>0)
             <center><ul class="pagination">
{{ $pools->links() }}
 </ul></center>
 @endif
             </div>

     </div>
         </div>
    <br><br>
    </div>

    </div>
  </div>
</div>
<!-- venue info code ends here -->
 @endsection
