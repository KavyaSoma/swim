@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <div class="container" id="main-code">
    <!-- Dashboard code starts here -->
<div class="container" id="main-code">
    <br/>    
    <ul class="nav nav-tabs preview_tabs">
      <li><a href="{{url('/events')}}">All Events</a></li>
      <li class="active"><a href="javascript:;">My Events</a></li>
    </ul> 
  <section class="main" style="margin-top:20px">
    <div class="col-xs-12 col-sm-6">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default active col-md-12">
              <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingOne">
                  <h3 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span class="glyphicon glyphicon-calendar"></span> 
                      Upcoming Events <span class="badge">5</span></a><br></a>
                  </h3>
              </div>
                <div id="collapseOne" class="panel-collapse collapse in"  role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body"  id="user_scroll">
                  <ul class="media-list">
                      <li class="media">
                          <div class="media-left">
                              <div class="panel panel-default text-center date">
                                  <div class="panel-heading month" style="background:#ff6600;color:#fff">
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
                              National Competitions
                            </div>
                          <div class="media-right">
                          <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
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
                              National Competitions
                          </div>
                          <div class="media-right">
                          <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
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
                              National Competitions
                            </div>
                          <div class="media-right">
                          <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                              <p>
                          <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
                              </p>
                          </div>
                      </li>
                  </ul>

              </div>
          </div>
          <!-- End fluid width widget -->
  </div>
  <div class="panel panel-default col-xs-12 col-sm-12">
        <div class="panel-heading" style="margin-left:-15px;margin-right:-15px;background:#46A6EA;color:#fff"  role="tab" id="headingTwo">
            <h3 class="panel-title">  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
  <span class="glyphicon glyphicon-calendar"></span> 
                Completed Events <span class="badge">5</span></a>
            </h3>
        </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body"  id="user_scroll">
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
                        National Competitions

                    </div>
                    <div class="media-right">
                    <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                        <p>
                    <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
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
                        National Competitions
                      </div>
                    <div class="media-right">
                    <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                        <p>
                    <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
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
                        National Competitions
                    </div>
                    <div class="media-right">
                    <a href="#" class="icon-block"><i class="fa fa-edit" style="color:#ff6600" title="Edit"></i></a>
                        <p>
                    <a href="#" class="icon-block"><i class="fa fa-share-alt" style="color:  #46A6EA;"  title="Share"></i></a>
                        </p>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <!-- End fluid width widget -->
  </div>
  </div>
  </div>
<div class="col-xs-12 col-sm-6">
  <!-- /panel -->
<div class="panel panel-default magic-element isotope-item widgets" style="margin-top:11px;">
  <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
    <h4 class="pb-title"style="padding:5px">My Events</h4>
  </div>
  <div class="panel-body">
    <div class="table table-responsive" id="user_scroll">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Event Name</th>
        <th>Schedule</th>
        <th>Settings</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Backstroke</td>
        <td>26-Apr-2018</td>
        <td>
    <div class="dropdown">
  <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
  <span class="caret"></span></i>
  <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list">  Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
  </ul>
</div>
</td>
      </tr>
      <tr>
        <td>Freestyle</td>
        <td>2-May-2018</td>
        <td>
          <div class="dropdown">
  <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
  <span class="caret"></span></i>
  <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list"> Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
  </ul>
  </div>
  </td>
      </tr>
      <tr>
        <td>Sppedo Pro Swimmers</td>
        <td>21-May-2018</td>
        <td>
          <div class="dropdown">
    <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
    <span class="caret"></span></i>
    <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list">  Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
    </ul>
    </div>
    </td>
      </tr>
      <tr>
        <td>Butterfly</td>
        <td>03-June-2018</td>
        <td>
          <div class="dropdown">
    <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
    <span class="caret"></span></i>
    <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list">  Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
    </ul>
    </div>
    </td>
      </tr>
      <tr>
        <td>Backstroke</td>
        <td>26-Apr-2018</td>
        <td>
          <div class="dropdown">
  <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
  <span class="caret"></span></i>
  <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list">  Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
  </ul>
  </div>
  </td>
      </tr>
      <tr>
        <td>Butterfly</td>
        <td>03-June-2018</td>
        <td>
          <div class="dropdown">
    <i class="fa fa-cog dropdown-toggle"  data-toggle="dropdown">
    <span class="caret"></span></i>
    <ul class="dropdown-menu" style="margin-left:-58px;">
    <li><a href="#"><i class="fa fa-check"> Invite</i></a></li>
    <li><a href="#"><i class="fa fa-pencil"> Edit</i></a></li>
    <li><a href="#"><i class="fa fa-list">  Results Entry</i></a></li>
    <li><a href="#"><i class="fa fa-trash"> Cancel</i></a></li>
    </ul>
    </div>
    </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                          <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title"style="padding:5px">Notifications</h4>
                                </div>
                                <ul>
                              <li class="mt-list-item">

                              <div class="list-thumb">
                                <a href="#">
                                  <img alt="" style="max-width:70%" src="images/sravan.jpeg" height="50px">
                                </a>
                              </div>
                              <div class="list-item-content">
                                    <p>New event in your area<br>View more info <a href="#" style="color:#46A6EA">here</a></p>
                                  </div><br>
                                  </li>
                                  <li class="mt-list-item">
                                    <div class="list-thumb">
                                    <a href="#">
                                      <img alt="" style="max-width:70%" src="images/sravan.jpeg" height="50px">
                                    </a>
                                  </div>
                                  <div class="list-item-content">
                                        <p>New event in your area<br>View more info <a href="#" style="color:#46A6EA">here</a></p>
                                      </div>
                                      </li><br>
                                      <li class="mt-list-item">

                                      <div class="list-thumb">
                                        <a href="#">
                                          <img alt="" style="max-width:70%" src="images/sravan.jpeg" height="50px">
                                        </a>
                                      </div>

                                          <div class="list-item-content">
                                            <p>New event in your area<br>View more info <a href="#" style="color:#46A6EA">here</a></p>
                                          </div>
                                          </li>

                              </ul>


  </div>
</div>
<div class="col-xs-12 col-sm-6">
<div class="panel panel-default magic-element isotope-item widgets">
          <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
              <h4 class="pb-title"style="padding:5px">Invitation</h4>
          </div>
  <div class="panel-body">
    <ul class="media-list">
      <li class="media">
          <div class="media-left">
            <img src="images/sravan.jpeg" class="img-circle" width="65px" height="65px">
          </div>
          <div class="media-body">
            <p><b> User</b></p><p> 3-Aug-2018 </p>
            <p>Request to add instructor to club</p>
          </div>
          <div class="media-right">
              <a href="#"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
              <a href="#"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
          </div>
      </li>
      <li class="media">
          <div class="media-left">
            <img src="images/sravan.jpeg" class="img-circle" width="65px" height="65px">
          </div>
          <div class="media-body">
            <p><b> User</b></p><p> 3-Aug-2018 </p>
            <p>Request to add instructor to club</p>
          </div>
          <div class="media-right">
              <a href="#"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
              <a href="#"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
          </div>
      </li>
      <li class="media">
          <div class="media-left">
            <img src="images/sravan.jpeg" class="img-circle" width="65px" height="65px">
          </div>
          <div class="media-body">
            <p><b> User</b></p><p> 3-Aug-2018 </p>
            <p>Request to add instructor to club</p>
          </div>
          <div class="media-right">
              <a href="#"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
              <a href="#"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
         </div>
      </li>
    </ul>
</div>
</div>
</div>

<div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                          <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title"style="padding:5px">Flagged</h4>
                                </div>
                          <div class="panel-body">
                            <div class="table table-responsive" id="user_scroll">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Event Name</th>
                                <th>Schedule</th>
                                <th>Settings</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Backstroke</td>
                                <td>26-Apr-2018</td>
                                <td>26-Apr-2018</td>
                                </tr>
                              <tr>
                                <td>Freestyle</td>
                                <td>2-May-2018</td>
                                <td>21-May-2018</td>
                              </tr>
                              <tr>
                                <td>Sppedo Pro Swimmers</td>
                                <td>21-May-2018</td>
                                <td>21-May-2018</td>
                              </tr>
                              <tr>
                                <td>Butterfly</td>
                                <td>03-June-2018</td>
                                <td>03-June-2018</td>
                              </tr>
                              <tr>
                                <td>Backstroke</td>
                                <td>26-Apr-2018</td>
                                  <td>26-Apr-2018</td>
                              </tr>
                              <tr>
                                <td>Butterfly</td>
                                <td>03-June-2018</td>
                                <td>03-June-2018</td>
                                </tr>
                            </tbody>
                          </table>
                        </div>


</div>
  </div>
</div>
</div>
<!-- /panel -->
</div>
<!-- Dash board code ends here -->
    </div>
@endsection
