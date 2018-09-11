@extends('layouts.main')
@section('content')
  <!-- login code starts here -->
  @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- Manage club starts here -->
<div class="container" id="main-code">
    <div class="fb-profile">
<h5 style="background-color:#46A6EA;color:#fff;"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-pencil"></i></button></a> Manage Clubs</h5>
<div class="row" style="border:1px solid #eee">
 <div class="board">
   <div class="board-inner">
     <center>
       <div class="table table-responsive">
        <table class="table">
<thead>
<tr>
<th>Club Name</th>
<th>Type</th>
<th>Mobile</th>
<th>Email</th>
<th>Website</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
@foreach($clubinfo as $club)
<tbody>
<tr>
<td>{{$club->ClubName}}</td>
<td>{{$club->ClubType}}</td>
<td>{{$club->MobilePhone}}</td>
<td>{{$club->Email}}</td>
<td>{{$club->Website}}</td>
<td><a href="{{ url('editclub/'.$club->ClubId)}}" class="btn btn-primary edit_button">
                      <i class="fa fa-edit"></i> Edit</a></td>
<td> <a href="{{url('deleteclub/'.$club->ClubId)}}" class=" btn btn-primary delete_button">
                        <i class="fa fa-trash"></i> Delete</a></td>
</tr>
</tbody>
@endforeach
</table>
</div>
 </center>
 </div>
  @if(count($clubinfo)>0)
 <div class="text-center">
   <ul class="pagination">
{{ $clubinfo->links() }}
 </ul>
 </div>
</div>
@endif
</div>
</div>
</div>
 <!-- Manage ends here -->
 @endsection