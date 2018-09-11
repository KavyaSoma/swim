@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- club-profile starts here -->
<div class="container" id="main-code">
     <div class="fb-profile">
         <img align="left" class="fb-image-lg" src="{{asset('images/swimm2.jpg')}}" alt="cover image"/>
         <img align="left" class="fb-image-profile thumbnail" src="{{asset('images/sravan.jpeg')}}" alt="Profile image"/>
     <div class="fb-profile-text">
         <h3>Sravan</h3>
         <p>Club Admin</p>
        <hr>
      <center>
        <div class="row">
          <div class="col-sm-2  col-xs-4 followers">
          <p>Followers <a href="#"><span class="badge">50</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 following ">
              <p>Following <a href="#"><span class="badge">70</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 members ">
              <p>Members <a href="#"><span class="badge">30</span></a></p>
            </div>
          </div>
  </div>
        <hr>
        <h5 style="background-color:#46A6EA;color:#fff;"><a href="{{url('addclub')}}"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Club</h5>

<div class="row" style="border:1px solid #eee">
  <div class="board">
    <div class="board-inner">
      <center><ul class="nav nav-tabs nav_info" id="myTab">
          <div class="liner"></div>
           <li>
              <a href="{{url('/addclub')}}" title="Basic Details">
                <span class="round-tabs">
                  <i class="fa fa-info"></i>
                </span>
               </a>
             </li>
               <li>
                 <a href="{{url('/clubaddress')}}" title="Address">
                    <span class="round-tabs">
                      <i class="fa fa-map-marker"></i>
                   </span>
                </a>
               </li>
                <li>
                  <a href="{{url('clubcontact')}}" title="Contact">
                    <span class="round-tabs">
                      <i class="fa fa-phone"></i>
                    </span>
                 </a>
                </li>
                 <li class="active">
                   <a href="{{url('clublinks')}}" title="Social Links">
                      <span class="round-tabs">
                        <i class="fa fa-globe"></i>
                     </span>
                    </a>
                  </li>
                </ul></center>
                </div>
<div class="tab-content tab_details">
<div class="tab-pane fade in active" id="social">
    <form class="form-horizontal" style="background:#fff;padding:35px" method="post" action="">
      {{csrf_field()}}
      <div class="col-sm-12">
        <div class="form-group">
          <label class="control-label col-sm-4" for="txt">Facebook:</label>
              <div class="col-sm-6">

                <input type="text" class="form-control" id="txt" name="facebook" value="{{old('facebook')}}" required>
              </div>
      </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="email">Google+:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="google" value="{{old('google')}}" required>
                </div>
      </div>
      <div class="form-group">
            <label class="control-label col-sm-4" for="txt">Twitter:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txt" name="twitter" value="{{old('twitter')}}" required>
                </div>
    </div>
     <div class="form-group">
        <label class="control-label col-sm-4" for="txt">Others:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="txt" name="others" value="{{old('others')}}" required>
              </div>
    </div>
     
    <center>
       <a href="{{ url('/editclub/'.$clubid) }}" class="btn btn-primary">
         Back
       </a>
      <button class="btn btn-primary" type="submit">Submit</button><br><br>
     </form> 

    </div>

 

</div>

</div>
</div>
</div>
</div>
</div>

@endsection