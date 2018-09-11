@extends('layouts.main')
@section('content')
<!-- mail box code starts here -->
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<div class="container" style="margin-top:20px;" id="main-code">
   <ol class="breadcrumb" style="background:#46A6EA;">
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item active">Heat setup & Result entry</li>
 </ol> 
   <div class="row text-center"> 
    @if( count($events)>0 )
    <table class='table table-striped' style="text-align:left;">
        <tr><th>Event Name</th><th>Heat setup</th><th>Results entry</th></tr>    
    @foreach($events as $event)
            <tr><td>{{ $event->EventName }}</td><td><a href="{{ url('heatsetup/'.$event->EventId)}}" style="color:#000;">setup heats?</a></td><td><a href="#" style="color:#000;">results entry?</a></td></tr>
    @endforeach    
    </table>
      @if(count($events)>0)
 <div class="text-center">
   <ul class="pagination">
{{ $events->links() }}
 </ul>
 </div>
</div>
@endif
    @else
    <h4>You have not created any events yet to setup Heats , <a href='{{ url('addevent') }}'>Click here</a> to create an event.</h4>
    @endif
</div>
</div>
</div>
</div>
<!-- mailbox code ends here -->
@endsection    