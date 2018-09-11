@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin-left:13px;text-align:center ">
    {!! session('message.content') !!}
    </div>
    @endif

    <div class="container">
  <h5 class="add_venue" style="padding:10px;"><span class="" style="font-size:17px;" ><i class="fa fa-calendar"> </i> </span> Add Venue</h5>
      <div class="row" style="border:1px solid #eee;margin-left:0px;margin-right:0px;box-shadow: 0 3px 8px #ddd;">
             <div class="board">
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                 <div class="board-inner  iconlist">
                 <ul class="nav nav-tabs nav_info" id="myTab">
                 <div class="liner"></div>
                <li>
                  <a href="{{ url('editvenue/'.$venue_id) }}" title="Venue Summary">
                   <span class="round-tabs">
                           <i class="fa fa-list"></i>
                   </span>
               </a></li>

               <li><a href="{{ url('edit-venuepool/'.$venue_id) }}"  title="Pool Information">
                  <span class="round-tabs">
                      <i class="fa fa-info"></i>
                  </span>
        </a>
              </li>
              <li  class="active"><a href="{{ url('edit-venueaddress/'.$venue_id) }}" title="Address & Contact">
                  <span class="round-tabs">
                       <i class="fa fa-phone"></i>
                  </span> </a>
                  </li>

                  <li><a href="{{ url('edit-venuetimings/'.$venue_id) }}" title="Open hours & Facilities">
                      <span class="round-tabs">
                           <i class="fa fa-clock-o"></i>
                      </span>
                  </a></li>
                  <li><a href="{{ url('edit-venuesociallinks/'.$venue_id) }}" title="Web site & Social Links">
                      <span class="round-tabs">
                           <i class="fa fa-share-alt"></i>
                      </span>
                  </a></li>

                  <li ><a href="{{url('confirmvenue/'.$venue_id)}}" title="Confirm Venue">
                      <span class="round-tabs">
                           <i class="fa fa-check"></i>
                      </span> </a>
                  </li>

                  </ul></div>
                   <div class="tab-pane fade in active" id="venuecontact">

                      <form class="form-horizontal" style="background:#fff;" method="post" action="{{ url('edit-venueaddress/'.$venue_id) }}">
                        {{csrf_field()}}
                          <h5 style="color:#46A6EA"><b>Address</b></h5><hr>
                        <div class="row">
                          @foreach($venue_address as $address)
                        <div class="form-group">
                              <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Address:</label>
                                <div class="col-xs-7 col-sm-6">
                                  <input type="hidden" name="address_id" value="{{$address->AddressId}}">
                                  <input type="text" class="form-control" id="txt" name="address" value="{{$address->AddressLine1}}">
                                </div>
                                </div>
                              <div class="form-group">
                                <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="email">City:</label>
                                    <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="venue-city" name="city" value="{{$address->City}}" pattern="([A-zÀ-ž\s]){5,20}">
                                        <span class="city-error" style="color: red;display: none;">City Should contain Only characters</span>
                                    </div>
                              </div>
                                <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="email">Post Code:</label>
                                    <div class="col-xs-7 col-sm-6">
                                      <input type="text" class="form-control" id="post-code" name="post_code" value="{{$address->PostCode}}" pattern="([0-9]){3,25}">
                                      <span class="post-error" style="color: red;display: none;">Post Code Should contain Numeric Characters</span>
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="email">Town:</label>
                                      <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="town" name="town" value="{{$address->County}}" pattern="([A-zÀ-ž\s]){5,25}">
                                        <span class="town-error" style="color: red;display: none;">Town Should contain Only 5-25 characters</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="email">Country:</label>
                                      <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="country" name="country" value="{{$address->Country}}" pattern="([A-zÀ-ž\s]){3,25}">
                                        <span class="country-error" style="color: red;display: none;">Country Should contain Only 5-25 characters</span>
                                      </div>
                                  </div>
                                  <center>
                                    <button class="btn btn-primary mybtn" type="reset">Back</button>
                                    <button class="btn btn-primary mybtn">Save</button>
                                 </div>
 @endforeach
 
                               
                               </div>
                         </div>
                       </div>
 
                     </div>

                                 @endsection