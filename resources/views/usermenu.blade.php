 <div class="container">
     <div class="fb-profile">
     <img align="left" class="fb-image-lg" src="{{url('images/swimm2.jpg')}}" alt="cover image"/>
       @foreach($users as $user)
       @if($user->Image == "NA")
         <img align="left" class="fb-image-profile thumbnail" src="{{url('public/images/sravan.jpeg')}}" alt="Profile image"/>
         @else
          <img align="left" class="fb-image-profile thumbnail" src="{{$user->Image}}" alt="Profile image"/>
     @endif
     <div class="fb-profile-text">
         <h3>{{$user->UserName}}</h3>
         <p>{{$user->UserType}}</p>
         @endforeach
        <hr>
          <center><div class="row">
            <div class="col-sm-2 col-xs-4 followers">
              <p>Followers <a href="#"><span class="badge">0</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 following">
              <p>Following <a href="#"><span class="badge">0</span></a></p>
            </div>
          </div>
  </div>