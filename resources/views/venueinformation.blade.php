<!-- venue info code starts here -->
@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<div class="container" id="main-code">
  <div class="row" id="venuepreview_tabs">
    <div class="col-sm-8">
        <ul class="nav nav-tabs preview_tabs">
          <li class="active"><a data-toggle="tab" href="#venuepreview-basic"> <i class="fa fa-list" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
          <li><a data-toggle="tab" href="#venuepreview-pool"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Pool Details</a></li>
          <li><a data-toggle="tab" href="#venuepreview-events"> <i class="fa fa-calendar" aria-hidden="true" id="info_fa"></i>Events</a></li>
          <li><a data-toggle="tab" href="#venuepreview-address"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
          <li><a data-toggle="tab" href="#venuepreview-contact"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>
          <li><a data-toggle="tab" href="#venuepreview-social"> <i class="fa fa-globe" aria-hidden="true" id="info_fa"></i>Social Links</a></li>
          <button class="btn btn-primary pull-right mob-none">Edit</button>
      </ul>
      <div class="tab-content preview_details">
        <div id="venuepreview-basic" class="tab-pane fade in active">
          <form class="form-horizontal">
            <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
              <div>
                <h4 class="field_names">Venue Name</h4>
              </div>
                <p>Rock Swim</p><hr>
              <div>
                <h4 class="field_names">Venue Type</h4>
              </div>
                <p> Swim</p><hr>
              <div>
                <h4 class="field_names">Description</h4>
              </div>
              <p>text about venue</p><hr></div>
         </form>
       </div>
       <div id="venuepreview-pool" class="tab-pane fade">
         <form class="form-horizontal">
           <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
            <div>
                  <h4 class="field_names">Pool Name</h4>
            </div>
               <p>Aqua pool</p><hr>
               <div>
                 <h4 class="field_names">Pool Width</h4>
               </div>
               <p>20m</p><hr>
               <div>
                  <h4 class="field_names">Pool Length</h4>
              </div>
               <p>25m</p><hr>
               <div>
                  <h4 class="field_names">Shallow End</h4>
                </div>
               <p>5m</p><hr>
                <div>
                  <h4 class="field_names">Deep End</h4>
                </div>
               <p>5m</p><hr>
               <div>
                  <h4 class="field_names">Pool Area</h4>
                </div>
               <p>150m</p><hr>
               <div>
                  <h4 class="field_names">Pool Description</h4>
              </div>
               <p>Our goal is to provide best service to the swimmers from basic entry level at our venue.</p><hr>
             </div>
           </form>
         </div>
         <div id="venuepreview-events" class="tab-pane fade">
           <form class="form-horizontal">
             <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="row">
                 <div class="col-sm-12">
                   <div class="tab-content preview_details">
                        <div id="venuepreview-upcoming" class="tab-pane fade in active">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                             <div class="panel panel-default active col-md-12">
                                <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingOne">
                                <h3 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <span class="glyphicon glyphicon-calendar"></span> Upcoming Events</a>
                                </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in"  role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body">
                                    <ul class="media-list">
                                      <li class="media">
                                        <div class="media-left">
                                          <div class="panel panel-default text-center date">
                                            <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                              <span class="panel-title strong">Mar</span>
                                            </div>
                                            <div class="panel-body day text-default" style="color:#46A6EA">23
                                            </div>
                                            </div>
                                          </div>
                                          <div class="media-body">
                                            <h4 class="media-heading">Swimming
                                                          </h4>
                                                          <p>
                                                          National Competitions
                                                          </p>
                                                      </div>

                                                  </li>
                                                  <li class="media">
                                                      <div class="media-left">
                                                          <div class="panel panel-default text-center date">
                                                              <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                                                  <span class="panel-title strong">
                                                                      Jan
                                                                  </span>
                                                              </div>
                                                              <div class="panel-body text-default day" style="color:#46A6EA">
                                                                  16
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="media-body">
                                                          <h4 class="media-heading">
                                                              Swimming
                                                          </h4>
                                                          <p>
                                                                National Competitions
                                                          </p>
                                                      </div>
                                                  </li>
                                                  <li class="media">
                                                      <div class="media-left">
                                                          <div class="panel panel-default text-center date">
                                                              <div class="panel-heading month" style="background:#ff6600;color:#fff">
                                                                  <span class="panel-title strong all-caps">
                                                                      Dec
                                                                  </span>
                                                              </div>
                                                              <div class="panel-body text-default day" style="color:#46A6EA">
                                                                  8
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="media-body">
                                                          <h4 class="media-heading">
                                                                Swimming
                                                          </h4>
                                                          <p>
                                                              National Competitions
                                                          </p>
                                                      </div>
                                                  </li>
                                              </ul>
                                              <a href="#" class="btn btn-default btn-block col-sm-offset-4 col-sm-5" style="color:#46A6EA;width:30%">More Events »</a>
                                          </div>
                                      </div>
                                      <!-- End fluid width widget -->
                          </div>
                          <div class="panel panel-default col-md-12">
                                    <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingTwo">
                                        <h3 class="panel-title">  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="glyphicon glyphicon-calendar"></span> 
                                            Completed Events</a>
                                        </h3>
                                    </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul class="media-list">
                                            <li class="media">
                                                <div class="media-left">
                                                    <div class="panel panel-default text-center date">
                                                        <div class="panel-heading month"  style="background:#ff6600;color:#fff">
                                                            <span class="panel-title strong">
                                                                Mar
                                                            </span>
                                                        </div>
                                                        <div class="panel-body day text-default" style="color:#46A6EA">
                                                            23
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                          Swimming
                                                    </h4>
                                                    <p>
                                                        National Competitions
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <div class="panel panel-default text-center date">
                                                        <div class="panel-heading month"  style="background:#ff6600;color:#fff">
                                                            <span class="panel-title strong">
                                                                Jan
                                                            </span>
                                                        </div>
                                                        <div class="panel-body text-default day" style="color:#46A6EA">
                                                            16
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Swimming
                                                    </h4>
                                                    <p>
                                                          National Competitions
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <div class="panel panel-default text-center date">
                                                        <div class="panel-heading month"  style="background:#ff6600;color:#fff">
                                                            <span class="panel-title strong all-caps">
                                                                Dec
                                                            </span>
                                                        </div>
                                                        <div class="panel-body text-default day" style="color:#46A6EA">
                                                            8
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                  Swimming
                                                    </h4>
                                                    <p>
                                                        National Competitions
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="#" class="btn btn-default btn-block "  style="color:#46A6EA;width:30%">More Events »</a>
                                    </div>
                                </div>
                                <!-- End fluid width widget -->
                          </div>
                          </div>
                          <div class="box box-solid">
                            <div class="box-body">
                              <!-- /btn-group -->
                              <div class="input-group" style="margin-top:20px">
                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                                <div class="input-group-btn">
                                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                                </div>
                                <!-- /btn-group -->
                              </div>
                              <!-- /input-group -->
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="box box-primary" style="margin-top:10%">
                              <div class="box-body no-padding">
                              <div id="calendar"></div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
        </div>
      </div>
               <div class="col-sm-12">
                 <div class="box box-primary" style="margin-top:10%">
                   <div class="box-body no-padding">
                   <div id="calendar"></div>
                   </div>
                 </div>
             </div>
          </div><br>
          <center> <button class="btn btn-primary">Book an Event</button>
           </div>

            <div id="venuepreview-address" class="tab-pane fade">
               <form class="form-horizontal">
                 <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div>
                        <h4 class="field_names">Address</h4></div>
                     <p>Box 777,91 Western Road,Brighton.</p><hr>
                     <div>
                       <h4 class="field_names">City</h4></div>
                     <p>East Sussex</p><hr>
                     <div>
                        <h4 class="field_names">Post Code</h4></div>
                     <p> 232480</p><hr>
                     <div>
                        <h4 class="field_names">Town</h4></div>
                     <p> Lon,BN1 2NW</p><hr>
                  <div>
                        <h4 class="field_names">Country</h4></div>
                     <p> UK</p>
                   </div>
                 </form>
               </div>
                      <div id="venuepreview-contact" class="tab-pane fade">
                         <form class="form-horizontal">
                           <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div>
                       <h4 class="field_names">Contact</h4></div>
                     <p>1234567890</p><hr>
                     <div>
                        <h4 class="field_names">Mobile</h4></div>
                     <p>9134536467</p><hr>
                     <div>
                        <h4 class="field_names">Email</h4></div>
                     <p>swim.venue@gmail.com</p>
    </div>
    </form>
    </div>
    <div id="venuepreview-social" class="tab-pane fade">
       <form class="form-horizontal">
         <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
           <div>
     <h4 class="field_names">Facebook</h4></div>
   <p>www.facebook.com/swimmiq/venue</p><hr>
   <div>
      <h4 class="field_names">Twitter</h4></div>
   <p>www.twitter.com/swimmiq/venue</p><hr>
   <div>
      <h4 class="field_names">Google+</h4></div>
   <p>rockswim.venue</p>
</div>
</form>
</div>
    </div>
    <br><br>
    </div>
    <div class="col-xs-12 col-sm-4">
      <img class="img-responsive venue_image" src="images/swimm8.jpg" alt="venue"/>
      <h5 style="color:#46A6EA">Venue Name</h5>
      <p>Rock Swim</P>
      <i class="fa fa-map-marker" style="color:#46A6EA"></i> UK
      <h5 style="color:#46A6EA">Opening Hours</h5>
      <p>Monday-wednesday(8:00 AM to 3:00 PM)<br>
        Thursday-saturday(6:00 AM to 1:00 PM)<br>
        Sunday(6:00 AM to 11:00 AM)</p>
      <h5 style="color:#46A6EA">Facilities</h5>
      <div class="row">
        <div class="col-xs-2 col-sm-2">
      <img src="images/paraswimming.jpg" height="30px" width="30px" alt="paraswimming" title="Paraswimming"/>
        </div>
      <div class="col-xs-2 col-sm-2">
          <img src="images/parking.jpg" height="30px" width="30px" alt="parking" title="Parking"/>
      </div>
        <div class="col-xs-2 col-sm-2">
          <img src="images/swimpool.jpg" height="30px" width="30px" alt="pool" title="Pool"/>
         </div>
          <div class="col-xs-2 col-sm-2">
              <img src="images/shower.png" height="30px" width="30px" alt="shower" title="Shower"/>
           </div>
            <div class="col-xs-2 col-sm-2">
                  <img src="images/food.png" height="30px" width="30px" alt="food" title="Food Court"/>
             </div>
           </div><br>
             <div class="row">
              <div class="col-xs-2 col-sm-2">
                  <img src="images/gym.jpg" height="30px" width="30px" alt="gym" title="Gym"/>
                </div>
                <div class="col-xs-2 col-sm-2">
                    <img src="images/diving.png"  height="30px" width="30px"  alt="diving" title="Diving"/>
                  </div>
                  <div class="col-xs-2 col-sm-2">
                      <img src="images/kidszone.png"  height="30px" width="30px"  alt="Kids Zone" title="Kids Zone"/>
                    </div>
                    <div class="col-xs-2 col-sm-2">
                        <img src="images/instructors.png"  height="30px" width="30px"  alt="Instructors" title="instructors"/>
                      </div>
      </div>
    <br>
      <center><button class="btn btn-primary">Join Now</button><br><br>
    </div></div>
  </div>
</div>
<!-- venue info code ends here -->
@endsection
