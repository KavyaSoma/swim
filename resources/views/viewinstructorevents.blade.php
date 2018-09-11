@extends('layouts.calendarmain')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
	<div class="modal fade" id="myModalh" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h3 style="color:#46A6EA;background-color:#fff;padding-left:9px;">Book Instructor</h3>
</div><hr>
<div class="modal-body">
<form method="post" action="{{url('instructor/'.$shortname)}}">
{{csrf_field()}}                     
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
							 <label class="radio-inline containerh">Yes
							 <input type="radio" name="prefered_class" checked="checked"><span class="checkmarka"></span></label>
                               <label class="radio-inline containerh">No
							   <input type="radio" name="prefered_class" ><span class="checkmarka"></span></label>
                                 <label class="radio-inline"></label>
                            </div>
                          </div><br><br> 
                       </div>
                       <div class="modal-footer">
                         <center>
                         <button type="reset" class="btn btn-primary mybtn" >Reset</button>
                       <button type="submit" class="btn btn-primary mybtn">Submit</button>
                     </center>
                     </div>
                     </div>
                     </div>
                   
                 </div>
               </form>
</div>
</div>
</div></div>

<!-- model popup ends here -->
<!-- instructor preview code starts here -->
   @foreach($instructors as $instructor)
   <div class="container" id="main-code" style="margin-top:10px;background-color:#fff;">
   <div class="row  mob-none" style="padding-left: 10px;padding-right: 10px;">
   <div class="col-sm-7 col-xs-12"><h3>{{$instructor->FirstName}}</h3></div>

<div class="col-sm-5 col-xs-12" style="margin-top:1%">
       <center>
        @if(count($favourites)>0)
        <a href="{{url('instructor/'.$instructor->ShortName.'/unfollow')}}"><button class="btn btn-default mybtn"> <i class="fa fa-heart" title="favourite"></i> Unfollow</button></a>
        @else
        <a href="{{url('instructor/'.$instructor->ShortName.'/following')}}"><button class="btn btn-default mybtn"> <i class="fa fa-heart-o" title="favourite"></i> Follow</button></a>
        @endif
       
        <a href="{{url('sendmessage')}}"><button class="btn btn-default mybtn"><i class="fa fa-envelope" title="message" ></i> Message</button></a>
<button class="btn btn-default mybtn" style="background: #f60;color:#fff;" data-toggle="modal" data-target="#myModalh"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Book Instructor</button>
</center>
</div>
               <!--<center>
       
        <a href=""><button class="btn btn-default mybtn"> <i class="fa fa-heart" title="favourite"></i> Follow</button></a>
       
        <a href=""><button class="btn btn-default mybtn"><i class="fa fa-envelope" title="message" ></i> Message</button></a></center>-->
      </div>
<div style="margin-top: 15%;" class="desk-none tab-none mob-block row"><div class="col-xs-12"><h3>{{$instructor->FirstName}}</h3></div>

<div class="col-xs-12" style="margin-top:4%">
<a href=""><button class="btn btn-default mybtn"> <i class="fa fa-heart" title="favourite"></i> </button></a>
       
        <a href=""><button class="btn btn-default mybtn"><i class="fa fa-envelope" title="message" ></i> </button></a>
<button class="btn btn-default mybtn" data-toggle="modal" data-target="#myModalh"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Book Instructor</button>
</div>
</div>
     <div class="fb-profile">
 
 @include('instructorsidebar')
   <div class="col-sm-3 col-sm-12" style="padding-right: 0;padding-left: 0;border-left: 1px solid #ccc;">
	<div id="instructorpreview-basic" class="tab-pane fade in active">
        <form class="form-horizontal">
          <div class="col xs-12 col-sm-12">
         
              <h4 class="field_names">About</h4>
              <p>{{$instructor->Description}}.</p><hr>
           
			</div>


    <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
     
	<h4 class="field_names"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Address</h4>
  @foreach($instructoraddress as $address)
   <p>{{$address->AddressLine1}}</p>
   <p>{{$address->City}}</p>
   <p>{{$address->County}}</p>
   <p>{{$address->Country}}</p>
   @endforeach

    <div>
   <h4 class="field_names">Contact</h4></div>
   @foreach($instructors as $instructor)
   <p>Day Time : {{$instructor->DayTimePhone}}</p>
      Evening Phone : {{$instructor->EveningPhone}}</p>
   
   <p>Email : {{$instructor->Email}}</p>
   @endforeach
  
 </div>
</div>
</form>
</div>
        <div class="col-sm-6 col-xs-12" style="border-left:1px solid #ccc;">     
   @endforeach
   <div class="tab-content preview_details">
<div id="instructorpreview-events" class="tab-pane fade in active">
 <div class="col-sm-12">
<div class="box box-primary" style="margin-top:3%">
<div class="box-body no-padding">
   {!! $calendar->calendar() !!}
</div>
 </div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection