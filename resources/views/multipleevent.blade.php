@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
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
    <!-- event code starts here -->
     <div class="container mycntn" id="main-code">
  <ol class="breadcrumb" style="border:1px solid #46A6EA;color:#46A6EA;">
  <li class="breadcrumb-item"><a style="color:#777;" href="{{url('addevent/'.$event_id)}}">Add Event</a></li>
  <li class="breadcrumb-item">Schedule Event</li>
  </ol>
             <ul class="nav nav-tabs mob-none">
  <li ><a data-toggle="tab" class="" href="#mhome">Basic Details</a></li>
    <li class="active " style="margin-bottom:2px;"><a data-toggle="tab" class="" href="#home"> WHEN</a></li>
    <li><a class="" data-toggle="tab" href="#menu1"> WHERE</a></li>
    <li><a class="" data-toggle="tab" href="#menu2"> EVENT</a></li>
    
  </ul>
      <div class="col-xs-12 col-sm-3 kin_photo">
     <div class="fb-profile" style="margin-top:8%;">
 @if(count($event_image)>0)
 <img class="thumbnail profile_image" src="{{$event_image[0]->ImagePath}}" alt="Profile image">
 @else
 <img class="thumbnail profile_image" src="{{url('public/images/event.jpg')}}" alt="Profile image">
 @endif     <div class="fb-profile-text text-center">
         <!-- <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:UK</p>-->
</div>
</div>
</div>
<div class="col-sm-9 col-xs-12" style="border-left:1px solid #eee;padding:0">
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
              
<div class="tab-content tab_details">
  
                      <div class="tab-pane fade in active" id="eventschedule" style="padding:32px 8px;">
                          <div class="row">
                           
                              <div class="form-group" id="field1">
                                  <label class="control-label col-sm-2" for="txt">Occurance:</label>
                                         <ul class="nav nav-pills">
                <li><a href="{{url('schedule-event/'.$event_id)}}" style="background-color:#ddd;color:#46A6EA">One Time</a></li>
                <li class="active"><a href="{{url('multiple-event/'.$event_id)}}"  style="background-color:#46A6EA">Multiple</a></li>
                <li><a href="{{url('recurring-event/'.$event_id)}}" style="background-color:#ddd;color:#46A6EA">Recurring</a></li>
                @if(count($previous_entries)>0)<li style="margin-left: 280px">
                  <span class=" btn btn-warning" data-toggle="modal" data-target="#myModalh"><i class="fa fa-bars"></i> Previous Entries</span>
                </li>@endif
           </ul>
                                      
                              </div>
                    </div>
                      
                        <hr>
                         <form method="post" action="{{url('multiple-event/'.$event_id)}}" >
                              {{csrf_field()}}
                        <div class="fields">
                           <div id="add-event">
               <div class="col-md-4">
                <div class="form-group">
                <label class="control-label col-xs-3 col-sm-1" for="dte">Between:</label><br>
                <div class="input-group">
                    <input type="date" class="form-control" id="dte" name="start_date[]">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                </div>
              </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
              <label class="control-label col-xs-3 col-sm-1" for="dte">And:</label><br>
              <div class="input-group">
                  <input type="date" class="form-control" id="dte" name="end_date[]">
                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
              </div>
              </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
              <label class="control-label col-xs-3 col-sm-1" for="tme">At:</label><br>
              <div class="input-group col-sm-9">
                <input type="time" class="form-control" id="tme" name="time[]">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
              </div>
              </div>
              </div> 
 </div>
</div>
<center class="col-md-7 col-sm-offset-5">
      
        <span class="btn btn-primary pull-right mybtn" id="sub-event"><i class="fa fa-plus"> Add Another Date</i></span></center>
              </div>
<div class="col-sm-offset-3 col-sm-7 col-xs-offset-4">
              <a href="{{url('addevent/'.$event_id)}}" class="btn btn-primary mybtn" type="reset">Back</a>
         <button class="btn btn-primary mybtn">Save</button>
         @if(count($previous_entries)>0)
         <a href="{{url('/venue-event/'.$event_id)}}" class="btn btn-primary mybtn">Next</a>
         @else
         <a href="{{url('/venue-event/'.$event_id)}}" class="btn btn-primary mybtn disabled">Next</a>
         @endif
</div>
              </form>
               
            </div>


</div>
             
</div>

              </div>
              

                    </div>
                  </div>
                </div>
              </div>
<script>
$(function(){
  $("#sub-event").click(function(){
    $(".fields").append($('#add-event'));
  });
});
  console.log('{{ url('getoldevents/schedule/'.$event_id) }}');
$.ajax({
    url: '{{ url('getoldevents/schedule/'.$event_id) }}',
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
</script>
                      @endsection