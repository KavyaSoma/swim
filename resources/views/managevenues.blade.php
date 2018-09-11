@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- Manage club starts here -->
<div class="container" id="main-code">
     <div class="fb-profile">
<h5 style="background-color:#46A6EA;color:#fff;"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-pencil"></i></button></a> Manage Venues</h5>
<div class="row" style="border:1px solid #eee">
  <div class="board">
    <div class="board-inner">
      <center>
        <div class="table table-responsive">
          @if(count($venues)>0)
          <table class="table">
<thead>
<tr>
<th>Venue Name</th>
<th>Description</th>
<th>Mobile</th>
<th>Email</th>
<th>Website</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
@foreach($venues as $venue)
<tbody>
<tr>
<td>{{$venue->VenueName}}</td>
<td>@if(strlen($venue->VenueName)>25)
                                {{ substr($venue->VenueName,0,25) }}...
                                @else
                                {{ $venue->VenueName }}
                                @endif</td>
<td>{{$venue->Phone}}</td>
<td>{{$venue->Email}}</td>
<td>{{$venue->Website}}</td>
<td><a href="{{ url('editvenue/'.$venue->VenueId)}}" class="btn btn-primary edit_button">
                      <i class="fa fa-edit"></i> Edit</a></td>
<td> <a href="{{url('deletevenue/'.$venue->VenueId)}}" class=" btn btn-primary delete_button">
                        <i class="fa fa-trash"></i> Delete</a></td>
</tr>
</tbody>
@endforeach
</table>

</div>
  </center>
  </div>
 @if(count($venues)>0)
 <div class="text-center">
   <ul class="pagination">
{{ $venues->links() }}
 </ul>
 </div>
</div>
@endif
@else
<h4>No Venues</h4>
@endif
</div>
</div>
</div>
  <!-- Manage ends here -->
@endsection