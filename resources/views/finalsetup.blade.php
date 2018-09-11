@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <div class="alert alert-info" style="margin:13px;text-align: center;">
    Select Checkbox and Click Submit button to move participant to final
    </div>
    <!--Heat setup starts here -->
  <div class="container" style="margin-top:20px">
       <ul class="nav nav-tabs preview_tabs">
                                 <li><a href="{{url('heatsetup/'.$event_id)}}">Heat</a></li>
                                 <li><a href="{{url('semifinal/'.$event_id)}}">SemiFinal</a></li>
                                 <li class="active"><a href="{{url('finalsetup/'.$event_id)}}">Final</a></li>
                               </ul><br>
  <div class="row" style="border:1px solid #eee">
    <div class="board">
     <div class="tab-content tab_details">
                          

                    
                </div>
 
<div class="tab-pane fade in active" id="manageparticipants">
<div class="row" style="border:1px solid #eee">
 <table  class='table table-striped'>
  <tbody>
    <tr>
      <th></th>
      <th></th>
      <th>Particpants</th>
      <th>Result</th>
      <th>Stage</th>
    </tr>
    @if(count($participants)>0)
    <form method="post" action="{{url('finalsetup/'.$event_id)}}">
  {{csrf_field()}}
   @foreach($participants as $participant)
  <tr>
    <td></td>
     <td><div class="checkbox"><label><input type="checkbox" value="{{$participant->UserId}}" name="participants[]"></td>
      <td>{{$participant->UserName}}</label></td>
      <td>{{$participant->Result}}</td>
      <td><input type="hidden" name="semifinal_id[]" value="{{$participant->SemiFinal}}">Final</td>
   </div>
 </tr>
   @endforeach
 </tbody>
</table>
 </div>
 <br>

  <center>
<button class="btn btn-primary" style="margin-left: 40px">Submit</button>

 </center>
 </div>
</form>
<div class="row">
<center><ul class="pagination">
{{$participants->links()}}
</ul></center>
</div>
@else
sdfa
@endif
</div>
</div>
</div>
</div>
</div>
</div>

@endsection