@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- event code starts here -->
   <div class="container" id="main-code">
      <h5 class="add_venue" style="padding:10px;"><span class="" style="font-size:17px;" ><i class="fa fa-calendar"> </i> </span> Add Event</h5>
      <div class="row" style="border:1px solid #eee;margin-left:0px;margin-right:0px;box-shadow: 0 3px 8px #ddd;">
        <div class="board" id="board_height">
          <div class="board-inner event_iconlist" id="icons_align">
            <ul class="nav nav-tabs nav_info" id="myTab"  style="margin:40px 25%">
                <div class="liner"></div>
                <li  class="active">
                <a href="{{url('/editvenue/'.$event_id)}}" class="tab-one" title="Event Summary">
                  <span class="round-tabs">
                    <i class="fa fa-bullhorn"></i>
                  </span>
                 </a></li>
                 <li><a href="#" title="Sub Events">
                   <span class="round-tabs">
                     <i class="fa fa-list"></i>
                   </span>
                 </a>
                    </li>
                  <li><a href="#" title="Schedule">
                      <span class="round-tabs">
                           <i class="fa fa-calendar"></i>
                      </span> </a>
                      </li>

                      <li><a href="#" title="Contacts">
                          <span class="round-tabs">
                               <i class="fa fa-phone"></i>
                          </span>
                      </a></li>
                      <li><a href="#" title="Venue">
                          <span class="round-tabs">
                               <i class="fa fa-paper-plane-o"></i>
                          </span>
                      </a></li>

                      <li><a href="#" title="Conform">
                          <span class="round-tabs">
                               <i class="fa fa-check"></i>
                          </span> </a>
                      </li>

                      </ul></div>
<div class="tab-content tab_details">
    <div class="tab-pane fade in active" id="eventsummary">
      <form class="form-horizontal" style="background:#fff;" method="post" action="{{url('editevent/'.$event_id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @foreach($event_details as $event)
        <div class="row">
          <div class="form-group" id="field1">
            <label class="control-label col-xs-4 col-sm-4" for="txt">Event Name:</label>
              <div class="col-xs-7 col-sm-6"> 
                  <input type="text" class="form-control" id="event-name" name="event_name" value="{{$event->EventName}}" pattern="([A-zÀ-ž\s]){3,25}" required>
                  <span class="name-error" style="color: red;display: none">Event Name should contain 3-25 characters.</span>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-xs-4 col-sm-4" for="txt">Description:</label>
                  <div class="col-xs-7 col-sm-6">
                      <textarea class="form-control" id="txt" name="description" required>{{$event->Description}}</textarea>
                  </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-4 col-sm-4" for="txt">Privacy:</label>
              <div class="col-xs-8 col-sm-4">
                
                <label class="radio-inline"><input type="radio" name="privacy" value="public" @if($event->Privacy == "public") checked @endif required>Public</label>
                  <label class="radio-inline"><input type="radio" name="privacy" value="private"  @if($event->Privacy == "private") checked @endif required>Private</label>
                    <label class="radio-inline"><input type="radio" name="privacy" value="personal"  @if($event->Privacy == "personal") checked @endif required>Personal</label>
                   
                    <label class="radio-inline"> <button class="btn btn-xs tooltips" data-container="body" data-placement="right" title=" 
                      Public means 'its shown for all users' ,
                      private means 'its shown for selected users' , 
                      Personal means 'its shown for personal invited users"> ? </button> </label>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4 col-sm-4" for="txt">Short Name:</label>
                  <div class="col-xs-7 col-sm-6">
                    <input type="text" class="form-control" id="short-name" name="short_name" value="{{$event->ShortName}}" readonly>
                  </div>
            </div>
            @endforeach
            <div class="form-group">
              <label class="control-label col-xs-4 col-sm-4" for="file">Image:</label>
                <div class="col-xs-7 col-sm-6">
                    <input type="file" class="form-control" id="file" name="image" value="{{old('file')}}">
                </div>
              </div>
              </div>
              
              <center>
                <button class="btn btn-primary mybtn" type="submit"> Save & Continue</button>
              </form>
                </div>
                    </div>
                  </div>
                </div>
              </div>
        @endsection