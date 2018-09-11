@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Dashboard code starts here -->
<div class="container" id="main-code">
  <section class="main" style="margin-top:20px">
    <section class="tab-content">
      <section class="tab-pane active fade in active">
        <div class="row" id="dashboard-mob">
              <div class="col-xs-12 col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <a href="#"><i class="fa fa-plus-circle" style="color:#46A6EA;"></i></a> Add User
                  </div>
                    <div class="panel-body">
                      <form class="form-horizontal" action="{{url('admindashboard/adduser')}}" method="post">
                        {{csrf_field()}}
                       <div class="form-group">
                          <label class="control-label col-sm-4" for="txt">User Name:</label>
                          <div class="col-sm-6">
                          <input type="text" class="form-control" id="username" name="username" onchange="input('{{ url('register') }}')" required>
                        
                          </div>
                          </div>
                           <div class="form-group">
                          <label class="control-label col-sm-4" for="mail">Email:</label>
                          <div class="col-sm-6">
                          <input type="email" class="form-control" id="email" name="email" onchange="emailcheck()"  required>
                           <div class="error-email" style="color:red;"></div>
                          </div>
                        </div>
                          <div class="form-group">
                          <label class="control-label col-sm-4" for="pwd">Password:</label>
                          <div class="col-sm-6">
                          <input type="password" class="form-control" id="password" name="password" onchange="password('{{url('register')}}')" required>
                            <div id="pass" style="color: red;display:none"><li>Invalid Password</li></div>
                          </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">User Type:</label>
                              <div class="col-sm-6">
                            <select class="form-control" id="sel" name="user_type">
                              <option>Club Admin</option>
                              <option>Venue Admin</option>
                              <option>System Admin</option>
                              <option>Instructor</option>
                          </select>
                          </div>
                          </div>
                          <div class="form-group">
                                <div class="col-sm-6">
                          <input type="hidden" class="form-control" id="display" name="shortname" readonly>
                          </div>
                          </div>
                          <center><button type="submit" class="btn btn-primary">Submit</button></center>
                        </div>
                      </form>
                       </div>
                      </div>
                      <div class="col-xs-12 col-sm-8">
                        <div class="panel panel-default magic-element isotope-item">
                                  <div class="panel-body-heading edituser_panel">
                                      <h4 class="pb-title" style="padding:5px">Edit User</h4>
                                  </div>
                                  <div class="panel-body">
                                  <div class="col-xs-4 col-sm-3">
                                   
                                  </div>
                                 
                                  <div class="col-xs-4 col-sm-offset-5 col-sm-3">
                                  <form action="{{ url('admindashboard') }}" method="post">
                                      {{ csrf_field() }}
                                    <div class="form-group">
                                      @if($search_term='')
                                      <input type="text" class="form-control" id="txt" placeholder="Search.." name="search_term" required>
                                      @else
                                      <input type="text" class="form-control" id="txt" placeholder="Search.." name="search_term" value="{{ $search_term }}" required>
                                      @endif
                                    </div>
                                  </form>
                                  </div>
                                  <div class="table table-responsive">
                                    <table class="table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                        <th>S.no</th>
                                        <th>User Name</th>
                                        <th>User Type</th>
                                        <th>Email</th>
                                        <th>Edit/Delete</th>
                                        </tr>
                                      </thead>
                                      @foreach($users as $user)
                                        <tbody>
                                          <tr>
                                            <td>{{$user->UserId}}</td>
                                            <td>{{$user->UserName}}</td>
                                            <td>{{$user->UserType}}</td>
                                            <td>{{$user->Email}}</td>
                                            <td><a href="{{url('edituser/'.$user->UserId)}}" class="icon-block"><i class="fa fa-edit user_edit" title="Edit"></i></a> / <a href="{{url('deleteuser/'.$user->UserId)}}" class="icon-block"><i class="fa fa-trash user_delete"</i></a></td>
                                          </tr>
                                         
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                @if(count($users)>0)
 <div class="text-center">
   <ul class="pagination">
{{ $users->links() }}
 </ul>
 </div>
</div>
@endif
                              </div>
  </div>
  </div>
  <br>
  <div class="col-xs-12 col-sm-4 post_news well">
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-plus-sign" ></span><b> Add</b></a></li>
    <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-share"></span> <b>Post</b></a></li>
    <li><a data-toggle="tab" href="#menu2"><span class="glyphicon glyphicon-remove-circle"> <b>Completed</b></span></a></li>  
    
  </ul>

  <div class="tab-content" id="user_scroll">
    <div id="home" class="tab-pane fade in active">
      <br>
      <ul class="media-list">
        @if(count($adds)>0)
        @foreach($adds as $add)
                          <li class="media">
                            @if($add->ImagePath == 'NA')
                              <div class="media-left">
                                <img src="{{url('public/images/advertisement.png')}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @else
                              <div class="media-left">
                                <img src="{{url($add->ImagePath)}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @endif
                              <div class="media-body">
                                <p><b> {{$add->Subject}}</b></p><p>{{$add->PublishDate}}</p>
                                <p>{{$add->Message}}</p>
                              </div>
                              <div class="media-right">
                                  <a href="{{url('acceptrequest/'.$add->AdvertisementId)}}"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
                                  <a href="{{url('rejectrequest/'.$add->AdvertisementId)}}"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
                              </div>
                          </li>
                          @endforeach
                      @else
                      <h4>No Requests available</h4>
                    @endif
              </ul>
    </div>
    <div id="menu1" class="tab-pane fade">
      <br>
      <ul class="media-list">
        @if(count($posts)>0)
        @foreach($posts as $post)
                          <li class="media">
                            @if($post->ImagePath == 'NA')
                             <div class="media-left">
                                <img src="{{url('public/images/defaultnews.png')}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @else
                             <div class="media-left">
                                <img src="{{$post->ImagePath}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @endif
                              <div class="media-body">
                                <p><b> {{$post->Subject}}</b></p><p>{{$post->PublishDate}}</p>
                                <p>{{$post->Message}}</p>
                              </div>
                              <div class="media-right">
                                  <a href="{{url('acceptrequest/'.$post->AdvertisementId)}}"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
                                  <a href="{{url('rejectrequest/'.$post->AdvertisementId)}}"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
                              </div>
                          </li>
                          @endforeach
                          @else
                          <h4>No Requests Available</h4>
                          @endif
                        </ul>
    </div>
    <div id="menu2" class="tab-pane fade">
      <br>
      <ul class="media-list">
        @if(count($accept)>0)
        @foreach($accept as $accepts)
                          <li class="media">
                            @if($accepts->AdvertisementType == 'News')
                            @if($accepts->ImagePath == 'NA')
                              <div class="media-left">
                                <img src="{{url('public/images/defaultnews.png')}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @else
                               <div class="media-left">
                                <img src="{{$accepts->ImagePath}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @endif
                              @else
                              @if($accepts->ImagePath == 'NA')
                              <div class="media-left">
                                <img src="{{url('public/images/advertisement.png')}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @else
                               <div class="media-left">
                                <img src="{{$accepts->ImagePath}}" class="img-circle" width="65px" height="65px">
                              </div>
                              @endif
                              @endif
                              <div class="media-body">
                                <p><b> {{$accepts->Subject}}</b></p><p> {{$accepts->PublishDate}} </p>
                                <p{{$accepts->Message}}</p>
                              </div>
                              <div class="media-right">
                                @if($accepts->Status == "Accepted")
                                  <a href="#"><i class="fa fa-check-circle" aria-hidden="true" title="Accept" style="font-size:20px;color: #46A6EA;"></i></a>
                                  @else
                                  <a href="#"><i class="fa fa-times-circle-o" aria-hidden="true" title="Reject" style="font-size:20px;color: #d9534f;" ></i></a>
                                  @endif
                              </div>
                          </li>
                          @endforeach
                          @else
                          <h4>No Completed Requests</h4>
                          @endif
               
              </ul>
    </div>
    </div>
</div>
    </div>
  </section>
  </section>
  </section>
</div>
 <!-- Dashboard code ends here -->
 @endsection