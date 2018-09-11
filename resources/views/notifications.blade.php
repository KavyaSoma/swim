@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
  <div class="container" id="main-code">
    <h5 style="background-color:#46A6EA;color:#fff;"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button>Notifications</h5>
    <div class="col-sm-12">
    <div class="form-horizontal">
      @if(count($notifications)>0)
        @foreach($notifications as $alert)
        <div class="alert alert-info alert-dismissable"  id="{{ $alert->NotificationId }}" style="margin:13px;text-align: center;">
        	 <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    {!! $alert->Notification !!}
		    </div>
        @endforeach
        <div class="row text-center">
        <div class="col-lg-12">
        <ul class="pagination">
        {{ $notifications->links() }}
        </ul>
        </div>
        </div>
         @else
        <h2>No Notifications Available</h2>
        @endif
 </div>
</div>
</div>
    @endsection