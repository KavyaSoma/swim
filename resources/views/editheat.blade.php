@extends('layouts.main')
@section('content')
    <!--Heat setup starts here -->
 @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
  <div class="container" style="margin-top:20px">
                 <ul class="nav nav-tabs preview_tabs">
                                 <li class="active"><a href="{{url('heatsetup/'.$event_id)}}">Heat</a></li>
                                 <li><a href="">SemiFinal</a></li>
                                 <li><a href="">Final</a></li>
                               </ul>
  <div class="row" style="border:1px solid #eee">
    <div class="board">

      <div class="board-inner instructor_tabs">
        <center><ul class="nav nav-tabs nav_info" id="myTab">
            <div class="liner"></div>
              <li class="active">
                <a href=""  class="tab-one"title="Stage Summary">
                  <span class="round-tabs">
                    <i class="fa fa-list"></i>
                  </span>
                 </a>
               </li>
                 <li>
                   <a href="" title="Manage Participants">
                      <span class="round-tabs">
                        <i class="fa fa-plus"></i>
                     </span>
                  </a>
                 </li>
                </ul></center>
                  </div>
                   
                  <div class="tab-content tab_details">
                    
                    <div class="tab-pane fade in active" id="stagesummary">
                       @if(count($heat_details)>0)          
                      <form class="form-horizontal" style="background:#fff;" method="post" action="{{url('editheat/'.$event_id.'/'.$heat_id)}}">
                        {{csrf_field()}}
                        @foreach($heat_details as $heat_detail)
                        <div class="col-sm-12">
                          <div class="form-group">
                        
        <label class="control-label col-sm-4 form_heat" for="txt">Stage No:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="stage-no" name="stage_no" value="{{$heat_detail->StageNumber}}" required>
          <div id="error-msg" style="color:red;display: none">Stage No should contain 3-10 Numeric Characters</div>
        </div>
      </div>
<!--<div class="form-group">
<label class="control-label col-sm-4" for="txt">Stage Name:</label>
<div class="col-sm-6">
  <input type="text" class="form-control" id="stage-name" name="stage_name" required>
  <div id="msg" style="color:red;display: none">StageName should contain only Alphabets</div>
</div>
</div>-->
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Type of Heat Generation:</label>
<div class="col-sm-4">
<label class="radio-inline"><input type="radio" name="heat_generation" required>Manual</label>
<label class="radio-inline"><input type="radio" name="heat_generation" required>Automatic</label>
</div>
</div>
<div class="form-group">
  <label class="control-label col-sm-4 form_heat" for="txt" id="createevent_form">Heat Name:</label>
  <div class="col-sm-6">
    <input type="text" class="form-control" id="heat-name" name="heat_name" value="{{$heat_detail->HeatName}}" required>
    <div id="error" style="color: red;display: none">Heat Name should Contain 5-30 characters</div>
  </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-4" for="tme">Schedule Time:</label>
    <div class="col-sm-6">
      <div class="input-group">
          <input type="time" class="form-control" id="tme" name="schedule_time" value="{{$heat_detail->HeatTime}}" required>
          <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
      </div>
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-4" for="txt">Qualification:</label>
    <div class="col-sm-4">
    <label class="radio-inline"><input type="radio" name="qualification_time" value="0"  checked required>Qualification Time <input type="text" name="qualification" value="" style="width: 90px" placeholder="seconds"></label> 
    <label class="radio-inline"><input type="radio" name="qualification_time" value="1" style="margin-left:-29px;" required>Top from Heat <input type="text" name="qualification" style="width: 90px;margin-left: 13px;" placeholder="5"> <i class="fa fa-question" title="Enter top results to move to semifinal" style="font-size:24px"></i></label> 
      
    </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="tme">Schedule Date:</label>
        <div class="col-sm-6">
          <div class="input-group">
              <input type="date" class="form-control" id="tme" name="schedule_date" value="{{$heat_detail->HeatStartDate}}" required>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="txt">Max no of Participants:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control"  name="max_participants" value="{{$heat_detail->MaxNoOfParticipants}}" required> 
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="txt">Relay:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="relay" value="{{$heat_detail->Relay}}" required> 
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="txt">SwimCourse:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="course" value="{{$heat_detail->SwimCourse}}" required> 
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="txt">SwimStyle:</label>
        <div class="col-sm-6">
          <select class="form-control" id="sel" name="swim_style" required>
          @if($heat_detail->SwimStyle == "Any")
          <option value="Any" selected>Any</option>
          <option value="Butterfly">Butterfly</option>
          <option value="BackStroke">BackStroke</option>
          <option value="FrontStroke">FrontStroke</option>
          @elseif($heat_detail->SwimStyle == "Butterfly")
          <option value="Any" >Any</option>
          <option value="Butterfly" selected>Butterfly</option>
          <option value="BackStroke">BackStroke</option>
          <option value="FrontStroke">FrontStroke</option>
          @elseif($heat_detail->SwimStyle == "BackStroke")
          <option value="Any" >Any</option>
          <option value="Butterfly" >Butterfly</option>
          <option value="BackStroke" selected>BackStroke</option>
          <option value="FrontStroke">FrontStroke</option>
          @else
          <option value="Any" >Any</option>
          <option value="Butterfly" >Butterfly</option>
          <option value="BackStroke" >BackStroke</option>
          <option value="FrontStroke" selected>FrontStroke</option>
          @endif
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="txt">SpecialInstructions:</label>
        <div class="col-sm-6">
          <textarea class="form-control" name="specialinstructions" required>{{$heat_detail->VenueHeatSpecialInstructions}}</textarea>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="txt">Description:</label>
        <div class="col-sm-6">
          <textarea class="form-control" name="descriptions" required>{{$heat_detail->HeatNotes}}</textarea>
        </select>
        </div>
      </div>
      @endforeach
<center>
<a>
 <button class="btn btn-primary" type="reset">Cancel</button>
</a>
<button class="btn btn-primary">Save and Continue</button>
</form>
@endif
 </center>
</div>
</div>
 </div>
</div>

</div>
<div id="heat_participants">
  </div>
</div>

</div>
</div>
<script>
    $(document).ready(function() {
console.log('{{ url('oldscheduleheat/'.$event_id) }}');
$.ajax({
    url: '{{ url('oldscheduleheat/'.$event_id)  }}',
    success: function(html) {
      if(html=="no") {
      } else {
        console.log(html);
        //$('#old_events').attr("src",html);
        $('#heat_participants').html(html);
      }
    },
    async:true
  });
              });

</script>
@endsection