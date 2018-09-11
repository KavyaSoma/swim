@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Dashboard code starts here -->
  <div class="container" id="main-code" style="margin-top: 20px">
    <ol class="breadcrumb" style="background:#46A6EA;">
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item active">Result entry</li>
 </ol>
     <div class="container" style="margin-top:20px;background-color:#fff">
       <div class="col-sm-12">
   <div class="tab-content preview_details">
      <div id="stage1" class="tab-pane fade in active">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
           <div class="panel panel-default active col-md-12">
                       <!-- <div class="panel-heading" style="margin-left:-15px;margin-right:-15px"  role="tab" id="headingOne">
                          <ul class="nav nav-tabs preview_tabs">
                          @foreach($heat_participants as $heat_paarticipant)
                                <li onclick="participants('{{url('resultentry/'.$event_id.'/'.$heat_paarticipant->HeatId)}}')"><a data-toggle="tab" href="#heat1">{{$heat_paarticipant->HeatName}}</a></li>
                              @endforeach
                              </ul>
                        </div>-->
 
      <div id="heat1" class="tab-pane fade in active">
      <div class="panel-body">
    
      
      @if(count($participants)>0)
      <form method="post" action="{{ url('uploadexcel') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="event_id" value="{{$event_id}}">
          <input type="hidden" name="heat_id" value="{{$heat_id}}">
          <input type="hidden" name="stage" value="{{$level_id}}">
          <input type="file" name="excelfile" id="excelfile" required> 
          <button type="submit" class="btn btn-danger">Upload</button>
      </form>
      <hr/>
      <form method="post" action="{{url('resultentry/'.$event_id.'/'.$heat_id.'/'.$level_id)}}"> 
        {{csrf_field()}}
    <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Record Time</th>
        <th>Result</th>
      </tr>
    </thead>
    <tbody>
      @foreach($participants as $participant)
      <tr>
        <td><img src="{{ url('public/'.$participant->Image)}}" class="img-circle" height="40px" width="40px"><span> {{$participant->ParticipantName}}</span></td>
        <td>
          <div class="form-group">
          <div class="col-sm-6">
            <div class="input-group">
              <input type="hidden" name="event_id" value="{{$event_id}}">
          <input type="hidden" name="heat_id" value="{{$heat_id}}">
          <input type="hidden" name="stage" value="{{$level_id}}">
              <input type="hidden" name="userid[]" value="{{$participant->ParticipantId}}">
                <input type="text" class="form-control" id="tme" name="time[]" step="2" required>
            </div>
          </div>
        </div>
      </td>
        <td><div class="form-group">
        <div class="col-sm-6">
           <select class="form-control" name="result[]" required>
            <option value="">select</option>
            @if($level_id == 1)
            <option value="semifinal">Move to SemiFinal</option>
            <option value="failed">Failed</option>
            @elseif($level_id == 2)
            <option value="final">Final</option>
            <option value="failed">Failed</option>
            @else
            <option value="qualified">Qualified</option>
            <option value="failed">Failed</option>
            @endif
          </select>
        </div>
        </div></td>

      </tr>
      @endforeach
    </tbody>
</table>
</div>
  <center><button class="btn btn-primary">Submit</button></center>
</form>
@else

<h4>Participants Not Added to Heat</h4>
</div>
@endif

</div>

           </div>
</div>
</div>
</div>
 




   
           <!-- End fluid width widget -->
     </div>
     </div>
   </form>
   </div>

     </div>

</div>

</div>
</div>

</div>

</div>
<script>
  $(document).ready(function() {
console.log('{{ url('resultentry/'.$event_id.'/3') }}');
$.ajax({
    url: '{{ url('resultentry/'.$event_id.'/3')  }}',
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