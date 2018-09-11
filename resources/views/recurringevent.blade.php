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
 @endif      <div class="fb-profile-text text-center">
         
         <!-- <p class="text-center"><i class="fa fa-map-marker" style="color:#46A6EA"></i> Location:UK</p>-->
</div>
</div>
</div>
<div class="col-sm-9 col-xs-12" style="border-left:1px solid #eee;padding:0">
<div class="tab-content tab_details">
  
                      <div class="tab-pane fade in active" id="eventschedule">
                          <div class="row" style="padding:30px">
                            <div class="tab-pane" id="tab-3">
        <div class="container">
                           
                              <div class="form-group" id="field1">
                                  <label class="control-label col-sm-2" for="txt">Occurance:</label>
                                         <ul class="nav nav-pills">
                <li><a href="{{url('schedule-event/'.$event_id)}}" style="background-color:#ddd;color:#46A6EA">One Time</a></li>
                <li><a href="{{url('multiple-event/'.$event_id)}}"  style="background-color:#ddd;color:#46A6EA">Multiple</a></li>
                <li class="active"><a href="{{url('recurring-event/'.$event_id)}}" style="background-color:#46A6EA">Recurring</a></li>
                @if(count($previous_entries)>0)<li style="margin-left: 280px">
                  <span class=" btn btn-warning" data-toggle="modal" data-target="#myModalh"><i class="fa fa-bars"></i> Previous Entries</span>
                </li>@endif
           </ul>
                                      
                              </div>
                    </div>
                   
                      
             
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#week">By Week</a></li>
    <li><a data-toggle="tab" href="#month">By Month</a></li>
    <li><a data-toggle="tab" href="#year">By Year</a></li>
  </ul>
 <form method="post" action="{{url('week-event/'.$event_id)}}">
      {{csrf_field()}}
  <div class="tab-content">
    <div id="week" class="tab-pane fade in active">
      <div class=""  >
      <div class="col-sm-3 col-xs-6 row" style="margin-top:20px">
        <div class="">
					<label class="containerck">Monday
					<input id="checkbox1" type="checkbox" name="weekday[]" value="Monday">
					<span class="checkmarkck"></span>        
					</label>
                         
                    </div>
                    <div class="">
					<label class="containerck">Tuesday
					<input id="checkbox1" type="checkbox" name="weekday[]" value="Tuesday">
					<span class="checkmarkck"></span>        
					</label>
                        
                    </div>
                    <div class="">
					<label class="containerck">Wednesday
					<input id="checkbox1" type="checkbox" name="weekday[]" value="Wednesday">
					<span class="checkmarkck"></span>        
					</label>
                        
                    </div>
                    <div class="">
					<label class="containerck">Thursday
					<input id="checkbox4" type="checkbox" name="weekday[]" value="Thursday">
					<span class="checkmarkck"></span>        
					</label>
                       
                    </div>
                    <div class="">
					<label class="containerck">Friday
					<input id="checkbox5" type="checkbox" name="weekday[]" value="Friday">
					<span class="checkmarkck"></span>        
					</label>
                       
                    </div>
                    <div class="">
					<label class="containerck">Saturday
					<input id="checkbox6" type="checkbox" name="weekday[]" value="Saturday">
					<span class="checkmarkck"></span>        
					</label>
                      
                    </div>
                    <div class="">
					<label class="containerck">Sunday
					<input id="checkbox7" type="checkbox" name="weekday[]" value="Sunday">
					<span class="checkmarkck"></span>        
					</label>
                       
                    </div>
  </div>
  <div class="col-sm-6 row col-xs-6" style="margin-top:20px">
<div class="form-group">
    <label class="control-label col-sm-4" for="dte">Between:</label>
    <div class="input-group">
        <input type="date" class="form-control" id="dte" name="start_date">
        <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
    </div>
  </div>
<div class="form-group">
  <label class="control-label col-sm-4" for="dte">And:</label>
  <div class="input-group">
      <input type="date" class="form-control" id="dte" name="end_date">
      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-4" for="tme">At:</label>
  <div class="input-group">
    <input type="time" class="form-control" id="tme" name="time">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
  </div>
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

     <div id="month" class="tab-pane fade">
      <form method="post" action="{{url('month-event/'.$event_id)}}">
        {{csrf_field()}}
    <div>

                      <div class="form-group">
					  
                          <div class="radio">
						  
						  
                            <div class="col-sm-2 mob-none"><label class="radio-inline containerh"><b>The</b>
						  <input type="radio" name="month_details" value="mothly_day"><span class="checkmark"></span></label></div>
                              <div class="form-group">
                              <div class="col-sm-2">
                                      <select  class="form-control" id="sel" name="recuring_monthday">
                                        <option value="1">First</option>
                                        <option value="2">Second</option>
                                        <option value="3">Third</option>
                                        <option value="4">Fourth</option>
                                      </select>
                                      </div>
                                      <div class="col-sm-2">
                                    <select  class="form-control" id="sel" name="recuring_day">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                  </select>
                                </div>
                                  <div class="col-sm-2"><b>of Every</b></div>
                                    <div class="col-sm-2">
                                      <select  class="form-control" id="sel" name="recuring_month">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>
                                </div>
                                    <div class="col-sm-2"><b>Months</b></div>
                          </div></div></div><br><br>
                          <div class="radio">
						  <div class="col-sm-2 mob-none"><label class="radio-inline containerh"><b>The</b>
						  <input type="radio" name="month_details" value="monthly"><span class="checkmark"></span></label></div>
                              <div class="form-group">
                              <div class="col-sm-2">
                                      <select  class="form-control" id="sel" name="recuring_monthday">
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                      </select>
                                      </div>
                                      <div class="col-sm-2"><b>Day of Every</b></div>
                                    <div class="col-sm-2 mob-none"></div>
                                    <div class="col-sm-2">
                                      <select  class="form-control" id="sel" name="recuring_month">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>
                                </div>
                                    <div class="col-sm-2"><b>Months</b></div>
                          </div></div>
                    </div>
<br><br><br>

    <div class="row between_months">
    <div class="col-md-8">
    <div class="form-group">
    <label class="control-label col-sm-3" for="dte">Between:</label>
    <div class="input-group">
        <input type="date" class="form-control" id="dte" name="start_date">
        <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
    </div>
    </div>
    </div>
    <div class="col-md-8">
    <div class="form-group">
    <label class="control-label col-sm-3" for="dte">And:</label>
    <div class="input-group">
      <input type="date" class="form-control" id="dte" name="end_date">
      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
    </div>
    </div>
    </div>
    <div class="col-md-8">
    <div class="form-group">
    <label class="control-label  col-sm-3" for="tme">At:</label>
    <div class="input-group">
    <input type="time" class="form-control" id="tme" name="time">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
    </div>
    </div>
    </div>
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


    <div id="year" class="tab-pane fade">
      <form method="post" action="{{url('year-event/'.$event_id)}}">
        {{csrf_field()}}
      <div>
                    <div class="form-group">
                        <div class="radio">
						<div class="col-sm-2 mob-none"><label class="radio-inline containerh"><b>The</b>
						  <input type="radio" name="year" value="yearly"><span class="checkmark"></span></label></div>
						
                            <div class="form-group">
                            <div class="col-sm-2">
                                    <select  class="form-control" id="year_monthly_days">
                                      <option>First</option>
                                      <option>Second</option>
                                      <option>Third</option>
                                      <option>Fourth</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-2">
                                  <select  class="form-control" id="year_weekly_days">
                                  <option>Monday</option>
                                  <option>Tuesday</option>
                                  <option>Wednesday</option>
                                  <option>Thursday</option>
                                  <option>Friday</option>
                                  <option>Saturday</option>
                                  <option>Sunday</option>
                                </select>
                              </div>
                                <div class="col-sm-2"><b>of Every</div>
                                  <div class="col-sm-2">
                                    <select  class="form-control" id="year_monthly">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                </select>
                              </div>
                                  <div class="col-sm-2"><b>Months</div>
                        <br><br><br>

                          <div class="col-sm-2"><b>Every</b></div>
                            <div class="col-sm-8"><input type="text" class="form-control" id="txt" name="recuring_year" placeholder="Enter Number"></div>
                              <div class="col-sm-2"><b>Years</b></div>
                            <br><br>
                        <div class="radio">
						<div class="col-sm-2 mob-none"><label class="radio-inline containerh"><b>The</b>
						  <input type="radio" name="year" value="monthly"><span class="checkmark"></span></label></div>
						 
                            <div class="form-group">
                            <div class="col-sm-2">
                                    <select  class="form-control" id="sel" name="year_monthly_days">
                                      <option>1st</option>
                                      <option>2nd</option>
                                      <option>3rd</option>
                                      <option>4th</option>
                                    </select>
                                    </div>

                                <div class="col-sm-2"><b>Day of Every</div>
                                  <div class="col-sm-2"></div>
                                  <div class="col-sm-2">
                                  <select  class="form-control" id="sel" name="year_monthly">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                </select>
                              </div>
                                  <div class="col-sm-2"><b>Months</b></div>
                        </div></div><br><br><br>
                  </div>
                </div>
                      </div>
    </div>

                  <div class="row between_months">
                  <div class="col-md-8">
                  <div class="form-group">
                  <label class="control-label  col-sm-2" for="dte">Between:</label>
                  <div class="input-group">
                      <input type="date" class="form-control" id="dte" name="start_date">
                      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                  </div>
                  </div>
                  </div>
                  <div class="col-md-8">
                  <div class="form-group">
                  <label class="control-label col-sm-2" for="dte">And:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" id="dte" name="end_date">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                  </div>
                  </div>
                  </div>
                  <div class="col-md-8">
                  <div class="form-group">
                  <label class="control-label col-sm-2" for="tme">At:</label>
                  <div class="input-group">
                  <input type="time" class="form-control" id="tme" name="time">
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  </div>
                  </div>
                  </div>
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
                  </div>
                </div>
              </div>
            </center>
          </div>
        </center>
      </div>
    </center>
  </div>
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