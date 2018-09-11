@extends('layouts.calendarmain')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- instructor preview code starts here -->
   <div class="container" id="main-code">
     <div class="fb-profile">

  <div class="container" style="margin-top:20px;background-color:#fff;padding:10px">
      <div class="col-sm-9">
        @foreach($instructors as $instructor)
    <ul class="nav nav-tabs preview_tabs">
         <li><a href="{{url('instructor/'.$instructor->ShortName)}}"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorevents')}}"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i>Events</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructoraddress')}}"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorqualification')}}"> <i class="fa fa-globe" aria-hidden="true" id="info_fa"></i>Qualification</a></li>
         <li><a href="{{url('instructor/'.$instructor->ShortName.'/instructorcontact')}}"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
            <li class="active"s><a href="{{url('instructor/'.$instructor->ShortName.'/bookinstructor')}}"> Book Instructor</a></li>
   </ul>
   @endforeach
   <div class="tab-content preview_details">
<div id="instructorpreview-events" class="tab-pane fade in active">
 <div class="col-sm-12">
<div class="box box-primary" style="margin-top:10%">
<div class="box-body no-padding">
   {!! $calendar->calendar() !!}
</div>
 </div>
</div>
</div>
</div>
</div>
@include('instructorsidebar')  <br><br>

     <div class="col-xs-12 col-sm-9" style="margin-left: 14px;margin-top:20px ">     <!-- Modal content-->
                     <form method="post" action="{{url('instructor/'.$instructor->ShortName.'/bookinstructor')}}">
                      {{csrf_field()}}
                     <div class="modal-content">
                       <div class="modal-body">
                        <div class="form-group">
                           <label class="control-label col-sm-4" for="txt">Name:</label>
                           <div class="col-sm-6">
                            <input type="hidden" name="instructorid" value="{{$instructorid}}">
                           <input type="text" class="form-control" id="txt" name="name">
                           </div>
                         </div><br><br> <br>
                         <div class="form-group">
                           <label class="control-label col-sm-4" for="txt">Venue:</label>
                           <div class="col-sm-6">
                           <input type="text" class="form-control" id="txt" name="venue">
                           </div>
                         </div><br><br>
                         <div class="form-group">
                           <label class="control-label col-sm-4" for="txt">Location:</label>
                           <div class="col-sm-6">
                           <input type="text" class="form-control" id="txt" name="location">
                           </div>
                         </div><br><br> 
                         <div class="form-group">
                           <label class="control-label col-sm-4" for="txt">Start Date:</label>
                           <div class="col-sm-6">
                           <input type="date" class="form-control" id="txt" name="start_date">
                           </div>
                         </div><br><br> 
                         <div class="form-group">
                           <label class="control-label col-sm-4" for="txt">End Date:</label>
                           <div class="col-sm-6">
                           <input type="date" class="form-control" id="txt" name="end_date">
                           </div>
                         </div><br><br> 
                         <div class="form-group">
                           <label class="control-label col-xs-4 col-sm-4" for="txt">Class Prefered:</label>
                             <div class="col-xs-8 col-sm-6">
                               <label class="radio-inline"><input type="radio" name="prefered_class">Yes</label>
                                 <label class="radio-inline"><input type="radio" name="prefered_class">No</label>
                            </div>
                          </div><br><br> 
                       </div>
                       <div class="modal-footer">
                         <center>
                         <button type="reset" class="btn btn-primary" >Reset</button>
                       <button type="submit" class="btn btn-primary">Submit</button>
                     </center>
                     </div>
                     </div>
                     </div>
                   </div>
                 </div>
               </form>
</div>
</div>
</div>
</div>
</div>

@endsection