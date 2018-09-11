@extends('layouts.main')
@section('content')
<div class="row1">
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger }}">
        {{ $error }}
        </div>
    @endforeach
@endif
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content') !!}
    </div>
@endif
    <!-- profile starts here -->
    <div class="container">
     <div class="fb-profile">
         <img align="left" class="fb-image-lg" src="{{url('public/images/swimm2.jpg')}}" alt="cover image"/>
         <img align="left" class="fb-image-profile thumbnail" src="{{url('public/images/sravan.jpeg')}}" alt="Profile image"/>
     <div class="fb-profile-text">
         <h3>Sravan</h3>
         <p>Instructor</p>
  <hr>
      <center>
        <div class="row">
          <div class="col-sm-2  col-xs-3 followers">
          <p>Followers <a href="#"><span class="badge">50</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-3 following ">
              <p>Following <a href="#"><span class="badge">70</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 pull-right">
              <p>Experience<a href="#"> <span class="badge"> 3 yrs</span></a></p>
            </div>
          </div></center>
          </div>
        </div>
        <div class="container">
        <h5 class="add_instructor"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Instructor</h5>
        <div class="row" style="border:1px solid #eee">
          <div class="board">
            <div class="board-inner instructor_tabs">
              <center><ul class="nav nav-tabs nav_info" id="myTab">
                  <div class="liner"></div>
                    <li class="active">
                      <a href="{{url('addinstructorbasic')}}" class="tab-one" title="Basic Details">
                        <span class="round-tabs">
                          <i class="fa fa-info"></i>
                        </span>
                       </a>
                     </li>
                     <li>
                       <a href="#" title="Timings">
                          <span class="round-tabs">
                            <i class="fa fa-clock-o"></i>
                         </span>
                      </a>
                     </li>
                       <li>
                         <a href="#" title="Address">
                            <span class="round-tabs">
                              <i class="fa fa-map-marker"></i>
                           </span>
                        </a>
                       </li>
                       <li>
                         <a href="#" title="Experience">
                            <span class="round-tabs">
                              <i class="fa fa-globe"></i>
                           </span>
                          </a>
                        </li>
                        <li>
                          <a href="#" title="Contact">
                            <span class="round-tabs">
                              <i class="fa fa-phone"></i>
                            </span>
                         </a>
                        </li>
                      </ul></center>
                        </div>
                        <div class="tab-content tab_details">
                          <div class="tab-pane fade in active" id="instructor_basicdetails">
                            <form class="form-horizontal" id="form" method="post" action="{{ url('addinstructorbasic') }}" style="background:#fff;">
                              {{csrf_field()}}
                              <div class="col-sm-12">
                                <div class="form-group" id="input_field">
                              
              <label class="control-label col-sm-4" for="txt">First Name:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="txt" name="FirstName">
               
              </div>
            </div>
   <div class="form-group">
      <label class="control-label col-sm-4" for="txt">Last Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt" name="LastName">
        
      </div>
    </div>
     <div class="form-group">
        <label class="control-label col-sm-4" for="txt">Middle Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="txt" name="MiddleName">
           
        </div>
      </div>
       <div class="form-group">
      <label class="control-label col-sm-4" for="txt">Short Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt" name="ShortName">
      
      </div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-4" for="txt">Title:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt" name="Title">
      
      </div>
    </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="file">Profile Image:</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="file" name="file">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="file">Cover Image:</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="file" name="file">
    </div>
  </div>
 <!-- <div class="form-group">
      <label class="control-label col-sm-4" for="txt">Club Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt" name="txt">
      </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="file">Club Image:</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="file" name="file">
    </div>
  </div>-->
  <center>
    <a>
       <button class="btn btn-primary">Cancel</button>
     </a>
      
     <a href="{{url('instructortimings')}}"><button type="submit" class="btn btn-primary">Save</button></a>
    <a href="#instructor_timings" data-toggle="tab">
      <button class="btn btn-primary">Next</button><br><br>
    </a>
  </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</center>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection