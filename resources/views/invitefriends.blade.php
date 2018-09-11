@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Friends List code starts here -->
 <div class="container" id="main-code">
   <section class="main" style="margin-top:20px">
     <div class="col-xs-12 col-sm-12">
       <ul class="nav nav-tabs preview_tabs">
         <li class="active"><a data-toggle="tab" href="#invitefriends">Invite Friends</a></li>
         <li><a data-toggle="tab" href="#manageinvites">Manage Invites</a></li>
 </ul>
 <div class="tab-content preview_details">
      <div id="invitefriends" class="tab-pane fade in active">
        @if(count($events)>0)
        <div class="row" style="margin-top:20px">
         <div class="col-sm-4">
           <p><b style="color:#46A6EA">Event Name:</b>{{$events[0]->EventName}}</p>
         </div>
         <div class="col-sm-4">
           <p><b style="color:#46A6EA">Date & Time:</b>{{$events[0]->StartDateTime}}</p>
         </div>
         <div class="col-sm-4" style="margin-bottom: 9px">
          <input type="text" placeholder="Search">
         </div>
       </div>
      
      <div class="panel panel-default magic-element isotope-item" id="user_scroll">
        @if(count($participants)>0)
      
      <div class="panel-body">
         
            <div class="row">
               @foreach($participants as $participant)
            <div class="col-xs-12 col-sm-3">
              <div class="panel friend">
                    <tr>
                      <td class="mns">
                        <span class="mash">
                          @if($participant->Image == "NA")
                          <input type="hidden" name="participantid" value="{{$participant->ParticipantId}}">
                         <div class=" col-xs-4 col-sm-3">
                          <img src="{{url('public/images/profile.png')}}" class="img-circle pull-left" height="60px" width="60px"/></div>
                             @else
                             <div class=" col-xs-4 col-sm-3">
                          <img src="{{$participant->Image}}" class="img-circle pull-left" height="60px" width="60px"/></div>
                             @endif  
                          <span class="col-xs-4 col-sm-4 frnd_name">{{$participant->ParticipantName}}</span><br>
                          @if(count($status)>0)
                          <a href="{{url('invite/'.$events[0]->EventId.'/'.$participant->ParticipantId)}}" > <span class="col-xs-4 col-sm-4 frnd_name"><i class="fa fa-times plus"></i></span></a>
                          @else
                           <a href="{{url('invite/'.$events[0]->EventId.'/'.$participant->ParticipantId)}}" > <span class="col-xs-4 col-sm-4 frnd_name"><i class="fa fa-plus plus"></i></span></a>
                           @endif
                          </span></td>
                      </tr>
                    </div>
                  </div>
                     @endforeach
                     @endif
                            </div>
             
        </div>
      
        @endif
         </div>
       </div>
        <div id="manageinvites" class="tab-pane fade">
             @if(count($events)>0)
        <div class="row" style="margin-top:20px">
         <div class="col-sm-4">
           <p><b style="color:#46A6EA">Event Name:</b>{{$events[0]->EventName}}</p>
         </div>
         <div class="col-sm-4">
           <p><b style="color:#46A6EA">Date & Time:</b>{{$events[0]->StartDateTime}}</p>
         </div>
         <div class="col-sm-4" style="margin-bottom: 9px">
          <input type="text" placeholder="Search">
         </div>
       </div>
       @endif
           <div class="panel panel-default magic-element isotope-item">
           <div class="panel-body">
                 <div class="row">
                   @if(count($participants)>0)
      
                    @foreach($manageinvites as $manage)
            <div class="col-xs-12 col-sm-3">
              <div class="panel friend">
                    <tr>
                      <td class="mns">
                        <span class="mash">
                          @if($manage->Image == "NA")
                         <div class=" col-xs-4 col-sm-3">
                          <img src="{{url('public/images/profile.png')}}" class="img-circle pull-left" height="60px" width="60px"/></div>
                             @else
                             <div class=" col-xs-4 col-sm-3">
                          <img src="{{$manage->Image}}" class="img-circle pull-left" height="60px" width="60px"/></div>
                             @endif  
                          <span class="col-xs-4 col-sm-4 frnd_name">{{$manage->ParticipantName}}</span><br>
                          <a href="#" > <span class="col-xs-4 col-sm-4 frnd_name"><i class="fa fa-times plus"></i></span></a>
                          </span></td>
                      </tr>
                    </div>
                  </div>
                     @endforeach
                        
                                 </div>
                               
        
        </div>
        @else
        <h3>No Invites</h3>
        @endif
      

                </div>
</div>
</div>
</div>

</section>
</div>
<!--Friends List code ends here -->
 @endsection