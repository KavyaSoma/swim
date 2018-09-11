@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- event code starts here -->
    <div class="modal fade" id="myModalh" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h3 style="color:#46A6EA;background-color:#fff;padding-left:9px;">Previous Entries</h3>
</div>
<div class="modal-body">
<div id="old_events">
                
                </div>
</div>
<!--<div class="modal-footer">
    <button class="btn btn-primary col-sm-offset-5 col-sm-2 mybtn" type="submit">Post</button>

</div>--></div>
</div></div>
     <div class="container mycntn">
   <ol class="breadcrumb" style="border:1px solid #46A6EA;color:#46A6EA;">
 <li class="breadcrumb-item"><a style="color:#777;" href="{{url('addevent/'.$event_id)}}">Add Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('schedule-event/'.$event_id)}}">Schedule Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('venue-event/'.$event_id)}}">Event Venue</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('subevent/'.$event_id)}}">Sub Event</a></li>
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('eventtime/'.$event_id)}}">Event Time</a></li>
  <li class="breadcrumb-item">Contact Event</li>
  </ol>
 <div class="row" style="margin-left:0px;margin-right:0px;">
    <ul class="nav nav-tabs mob-none">
  <li ><a data-toggle="tab" class="" href="#mhome">Basic Details</a></li>
    <li ><a href=""> WHEN</a></li>
    <li><a class="" data-toggle="tab" href="#menu1"> WHERE</a></li>
    <li class="active " style="margin-bottom:2px;"><a class="" data-toggle="tab" href="#menu2"> EVENT</a></li>
    
  </ul>
  <ul class="nav nav-tabs desk-none tab-none mob-block" style="border-bottom:0px">
  <li ><a data-toggle="tab" class="" href="#mhome"><i class="fa fa-list" id="info_fa"> </i></a></li>
    <li style="margin-bottom:2px;"><a data-toggle="tab" class="" href="#home"><i class="fa fa-clock-o" id="info_fa"> </i> </a></li>
    <li><a class="" data-toggle="tab" href="#menu1"><i class="fa fa-map-marker" id="info_fa"> </i> </a></li>
    <li ><a class="" data-toggle="tab" href="#menu2"><i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i> </a></li>
    
  </ul>      <div class="row">
             <div class="col-xs-12 col-sm-3 kin_photo">
     <div class="fb-profile" style="margin-top:8%;">
 @if(count($event_image)>0)
 <img class="thumbnail profile_image" src="{{$event_image[0]->ImagePath}}" alt="Profile image">
 @else
 <img class="thumbnail profile_image" src="{{url('public/images/event.jpg')}}" alt="Profile image">
 @endif
     <div class="fb-profile-text text-center">
         
         <!-- <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:UK</p>-->
</div>
</div>
</div>
<div class="col-sm-8 col-xs-12" style="border-left:1px solid #eee">
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                 <div class="board-inner">
            <ul class="nav nav-tabs nav_info" id="myTab">
                <div class="liner"></div>
                      <li><a href="" title="Sub Events">
                   <span class="round-tabs">
                     <i class="fa fa-list"></i>
                   </span></a>
                    </li>
                  <li><a href="" title="Schedule">
                      <span class="round-tabs">
                           <i class="fa fa-calendar"></i>
                      </span> </a>
                      </li>

                      <li  class="active"><a href="" title="Contacts">
                          <span class="round-tabs">
                               <i class="fa fa-phone"></i>
                          </span>
                      </a></li>
                      <li ><a href="" title="Clubs">
                          <span class="round-tabs">
                               <i class="fa fa-flag"></i>
                          </span>
                      </a></li>
                      <li><a href="" title="Venue">
                          <span class="round-tabs">
                               <i class="fa fa-paper-plane-o"></i>
                          </span>
                      </a></li>

                      <li><a href="" title="Conform">
                          <span class="round-tabs">
                               <i class="fa fa-check"></i>
                          </span> </a>
                      </li>

 <li style="padding:32px">@if(count($contacts)>0)
                               <button class=" btn btn-warning" data-toggle="modal" data-target="#myModalh"><i class="fa fa-bars"></i> Previous Entries</button>
                               @endif
                       </li>
                      </ul></div>
 <div class="tab-content tab_details">
  
            <div class="tab-pane fade in active" id="eventcontact">
                     <form class="form-horizontal" style="background:#fff;padding:30px" method="post" action="{{ url('contact-event/'.$event_id) }}">    
                        {{ csrf_field() }}
                              <div class="row">

                                @if($show == "yes")
                                @foreach($contacts as $contact)
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="txt">Contact:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="hidden" name="contact_id" value="{{$contact->ContactId}}">
                                    <input type="text" class="form-control" id="econtact" name="event_contact" value="{{$contact->FirstName}}" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="txt">Mobile:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="text" class="form-control" id="eventmobile" name="event_mobile" value="{{$contact->Phone}}" required>
                                    <div id="mobile-error" style="color: red;display: none">Mobile Number Should Contain 10 Numeric Characters</div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="email">Email:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="email" class="form-control" id="contactemail" name="event_email" value="{{$contact->Email}}" required>
                                  </div>
                                </div>
                                @endforeach
                                @else
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="txt">Contact:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="text" class="form-control" id="econtact" name="event_contact" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="txt">Mobile:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="text" class="form-control" id="eventmobile" name="event_mobile" required>
                                    <div id="mobile-error" style="color: red;display: none">Mobile Number Should Contain 10 Numeric Characters</div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-2" for="email">Email:</label>
                                  <div class="col-xs-8 col-sm-9">
                                    <input type="email" class="form-control" id="contactemail" name="event_email" required>
                                  </div>
                                </div>
                                
                                @endif
                                <center>
                                        <a href="{{url('/eventtime/'.$event_id)}}" class="btn btn-primary mybtn">Back</a>
                                        <button class="btn btn-primary mybtn">Save</button>
                                        @if(count($contacts)>0)
                                        <a href="{{url('/club-event/'.$event_id)}}" class="btn btn-primary mybtn ">Next</a>
                                        @else
                                        <a href="{{url('/club-event/'.$event_id)}}" class="btn btn-primary mybtn disabled">Next</a>
                                        @endif
                                       
                                      </center>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              </div>
                            </div>
                              </div>
                              <div id="old_events">
                
                              </div>
                              </div>
    <script>

$(document).ready(function() {
var $regexname = /^([0-9]{7,15})$/;

  $("#eventmobile").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#mobile-error').show();
    }
    else{
      $('#mobile-error').hide();
    }
  });
console.log('{{ url('getoldevents/contacts/'.$event_id) }}');
$.ajax({
    url: '{{ url('getoldevents/contacts/'.$event_id) }}',
    success: function(html) {
      if(html=="no") {
      } else {
        console.log(html);
        //$('#old_events').attr("src",html);
        $('#old_events').html(html);
      }
    },
    async:true
  });
              });

$(document).ready(function() {
  var options = {
    data:[
      {"FirstName": "FirstName",
       "Phone":"Phone",
       "Email":"Email"}
    ],
  url: function(phrase) {
    return "{{ url('eventcontact/') }}/"+phrase;
  },
  getValue: "FirstName",
   list: {
    onSelectItemEvent: function() {
      var value = $("#econtact").getSelectedItemData().Phone;
      var email = $("#econtact").getSelectedItemData().Email;
      
      $("#eventmobile").val(value).trigger("change");
      $("#contactemail").val(email).trigger("change");
     }
  }
  };
  $("#econtact").easyAutocomplete(options); 
});
</script>
                      @endsection