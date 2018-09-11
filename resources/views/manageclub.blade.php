@extends('layouts.main')
@section('content')
  <!-- login code starts here -->
  @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
   <div class="container" id="main-code">
    <div class="fb-profile">
        <img align="left" class="fb-image-lg" src="images/swimm2.jpg" alt="cover image"/>
        <img align="left" class="fb-image-profile thumbnail" src="images/sravan.jpeg" alt="Profile image"/>
    <div class="fb-profile-text">
        <h3>Sravan</h3>
        <p>Club Admin</p>
        <hr>
          <center><div class="row">
            <div class="col-sm-2 col-xs-4 followers">
              <p>Followers <a href="#"><span class="badge">50</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 following">
              <p>Following <a href="#"><span class="badge">70</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 members">
              <p>Members <a href="#"><span class="badge">30</span></a></p>
            </div>
          </div>
  </div>
        <hr>
        <h5 style="background-color:#46A6EA;color:#fff;padding:5px">Manage Clubs</h5>
        <div class="container-fluid" style="border:1px solid #d4d4d4;padding:15px;">
<div class="row">
  @foreach($club_details as $club)
        <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
            <a href="#">
                          <div class="book-img-thumb">
                             <img src="images/swimm5.jpg"/>
                         <div class="swim-curve">
                             <div class="swim-curve-img">
                             </div>
                             <div class="swim-rate swim-rate-orange">
                              <span>5</span>
                             </div>
                             <div class="swim-name">
                                 <span class="m-name">{{$club->ClubName}}</span>

                             </div>
                             <div class="swim-lang">
                                 <span>{{$club->City}}</span>
                             </div>
                         <div class="swim-det">
                             <div class="swim-genre">
                                  <ul class="list-inline">
                                     <li>Detail</li>
                                     <li>Detail</li>
                                     <li>Detail</li>
                                 </ul>
                             </div>

                          </div>
                      </div>
                <a href="{{ url('editclub/'.$club->ClubId)}}" class="btn btn-primary edit_button col-xs-12 col-sm-6">
                      <i class="fa fa-edit"></i> Edit

                     </span>
                 </a>

                 <a href="{{url('deleteclub/'.$club->ClubId)}}" class=" btn btn-primary delete_button col-xs-12 col-sm-6">
                        <i class="fa fa-trash"></i>  Delete

                      </span>
                  </a>
             </div>
         </div>
         @endforeach
        </div>
         <div class="text-center">
           <ul class="pagination">

          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
           <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
      </div>
      </div>
    </div>
    </div>
      <!-- manage club code ends here -->
@endsection