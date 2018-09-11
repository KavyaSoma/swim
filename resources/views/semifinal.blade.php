@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Dashboard code starts here -->
  <div class="container" id="main-code">
     <div class="container" style="margin-top:20px;background-color:#fff">
       <div class="col-sm-8">
         <ul class="nav nav-tabs preview_tabs">
         <li ><a href="{{url('resultentry/'.$event_id)}}">Heats</a></li>
         <li class="active"><a href="{{url('semifinal/'.$event_id)}}">SemiFinals</a></li>
         <li><a href="{{url('final/'.$event_id)}}">Finals</a></li>
         <button class="btn btn-primary pull-right mob-none">Edit</button>
   </ul>

<div id="stage2" class="tab-pane fade in active">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
     <div class="panel panel-default active col-md-12">
                  <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;"  role="tab" id="headingThree">
                      <ul class="nav nav-tabs preview_tabs">
                          @foreach($semifinals as $semifinal)
                          @if($semifinal->SemiFinal == 0)
                          @else
                                <li onclick="semifinals('{{url('semifinal/'.$event_id.'/'.$semifinal->SemiFinal)}}')"><a data-toggle="tab" href="#heat1">Semifinal {{$semifinal->SemiFinal}}</a></li>
                                @endif
                              @endforeach
                              </ul>
                  </div>
      <div id="semi1" class="tab-pane fade in active">
              <div class="panel-body">
    <div  id="user_scroll">
      @if(count($semi_particpants)>0)

    <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Time</th>
        <th>Results</th>
      </tr>
    </thead>
    <tbody>
      <form method="post" action="{{url('semifinal/'.$event_id.'/'.$semifinal_id)}}">
        {{csrf_field()}}
      @foreach($semi_particpants as $semi_participant)
      <tr>
        <td><img src="{{url('public/images/sravan.jpeg')}}" class="img-circle" height="40px" width="40px"><span> {{$semi_participant->UserName}}</span></td>
        <td>
          <div class="form-group">
          <div class="col-sm-6">
            <div class="input-group">
              <input type="hidden" name="participantid[]" value="{{$semi_participant->EventResultId}}">
                <input type="time" class="form-control" id="tme" name="time[]" step="2">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
          </div>
        </div>
      </td>
        <td><div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" id="txt" name="result[]">
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
<h4>No Participants Added To SemiFinal</h4>
</div>
@endif
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