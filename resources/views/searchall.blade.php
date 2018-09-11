 @extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- instructor preview code starts here -->
   <div class="container" id="main-code">
     <div class="fb-profile">

  <div class="container" style="margin-top:20px;background-color:#fff;padding:10px">
            
                       <ul class="nav nav-tabs " role="tablist">
                         <li role="presentation" class="active"><a href="{{ url('search/all/?search_term='.$search_term) }}" aria-controls="mainall" role="tab">ALL</a></li>
                       <li role="presentation"><a href="{{ url('search/events/?search_term='.$search_term) }}" aria-controls="mainevents" role="tab">EVENTS</a></li>
                       <li role="presentation"><a href="{{ url('search/clubs/?search_term='.$search_term) }}" aria-controls="mainclubs" role="tab">CLUBS</a></li>
                       <li role="presentation"><a href="{{ url('search/venues/?search_term='.$search_term) }}" aria-controls="mainvenues" role="tab">VENUES</a></li> 
                       <li role="presentation"><a href="{{ url('search/instructors/?search_term='.$search_term) }}" aria-controls="maininstructors" role="tab">INSTRUCTORS</a></li>
                          <li role="presentation"><a href="{{ url('search/users/?search_term='.$search_term) }}" aria-controls="mainusers" role="tab">USERS</a></li>
                       </ul>

   <div class="tab-content preview_details">
<div class="tab-content">
   <div role="tabpanel" class="tab-pane active img-shadow" id="mainall">
         <div class="clearfix">
      @if( count($clubs) > 0 )    
      <h4>Search Results For Clubs </h4>
      @foreach($clubs as $club)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                       @if($club->ImagePath == "NA")
                      <img src="{{ url('public/images/club.jpg') }}"/>
                      @else
                       <img src="{{ $club->ImagePath }}"/>
                       @endif
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange" onclick="manageFavourites('{{ url('managefavourites/club/'.$club->ClubId.'/'.Session::get('user_id')) }}','{{ $club->ClubId }}')">
                        <span id="fav_{{ $club->ClubId }}"><i class="fa fa-heart-o"></i></span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{ $club->ClubName }}</span>

                       </div>
                       <div class="swim-lang">
                           <span id="favcount_{{ $club->ClubId }}"></span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            <ul class="list-inline">
                               <li>{{ $club->MobilePhone }}</li>
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{ url('club/'.$club->ShortName.'/') }}"  class="view-btn">
              View Club
          </span>
            </a>
       </div>
   </div>
               @endforeach
               
                </div>
 <center>            
 @if($search_term == '')
 <a href="{{ url('clubs') }}"><button class="btn btn-primary">View All Results</button></a>
 @else
 <a href="{{ url('search/clubs/?search_term='.$search_term) }}"><button class="btn btn-primary">View Al Results</button></a>
 @endif
</div>
@endif
    </center>              
 <div class="clearfix">
                  @if( count($venues) > 0 )
                  <h4 style="border-bottom:1px solid #eeeeee;">Search Results For Venues</h4>
                 @foreach($venues as $venue)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                       @if($venue->ImagePath == "NA")
                     <img class="img-responsive venue_image" src="{{ url('public/images/venue.jpg') }}" alt="venue"/>
                     @else
                    <img class="img-responsive venue_image" src="{{ $venue->ImagePath }}" alt="venue"/>
                    @endif
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange" onclick="manageFavourites('{{ url('managefavourites/venue/'.$venue->VenueId.'/'.Session::get('user_id')) }}','{{ $venue->VenueId }}')">
                        <span id="fav_{{ $venue->VenueId }}"><i class="fa fa-heart-o"></i></span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{ $venue->VenueName }}</span>

                       </div>
                       <div class="swim-lang">
                           <span id="favcount_{{ $venue->VenueId }}"></span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            <ul class="list-inline">
                               <li>{{ $venue->phone }}</li>
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{ url('venue/'.$venue->ShortName) }}" class="view-btn">
               View Venue

                </span>
            </a>
       </div>
   </div>
               @endforeach
          
             </div>
             <center>
               @if($search_term == '')
 <a href="{{ url('venues') }}"><button class="btn btn-primary">View All Results</button></a>
 @else
 <a href="{{ url('search/venues/?search_term='.$search_term) }}"><button class="btn btn-primary">View All Results</button></a>
 @endif
</div>
@endif
</center>
 <div class="clearfix">
  @if( count($instructors) > 0 )
                  <h4 style="border-bottom:1px solid #eeeeee;">Search Results For Instructors</h4>
                 @foreach($instructors as $instructor)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                      @if($instructor->Image == "NA")
                        <img src="{{ url('public/images/instructor.jpg') }}"/>
                        @else
                       <img src="{{ $instructor->Image }}"/>
                       @endif
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange" onclick="manageFavourites('{{ url('managefavourites/instructor/'.$instructor->UserId.'/'.Session::get('user_id')) }}','{{ $instructor->UserId }}')">
                        <span id="fav_{{ $instructor->UserId }}"><i class="fa fa-heart-o"></i></span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{ $instructor->UserName }}</span>

                       </div>
                       <div class="swim-lang">
                           <span id="favcount_{{ $instructor->UserId }}"></span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            <ul class="list-inline">
                               <li>{{ $instructor->Experience }} Years Experience</li>
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{ url('instructor/'.$instructor->ShortName.'/') }}"  class="view-btn">
                View Instructor
                </span>
            </a>
       </div>
   </div>
               @endforeach
              
             </div>
               <center>
               @if($search_term == '')
 <a href="{{ url('instructors') }}"><button class="btn btn-primary">View All Results</button></a>
 @else
 <a href="{{ url('search/instructors/?search_term='.$search_term) }}"><button class="btn btn-primary">View Al Results</button></a>
 @endif
</div>
@endif
</center>
 <div class="clearfix">
                  @if( count($events) > 0 )
                  <h4 style="border-bottom:1px solid #eeeeee;">Search Results For Events</h4>
@foreach($events as $event)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                    @if($event->ImagePath == "NA")
                     <img id="event_image" src="{{ url('public/images/event.jpg') }}" alt="event"/>
                     @else
                     <img id="event_image" src="{{ $event->ImagePath }}" alt="event"/>
                        @endif
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange" onclick="manageFavourites('{{ url('managefavourites/events/'.$event->EventId.'/'.Session::get('user_id')) }}','{{ $event->EventId }}')">
                        <span id="fav_{{ $event->EventId }}"><i class="fa fa-heart-o"></i></span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{ $event->EventName }}</span>

                       </div>
                       <div class="swim-lang">
                           <span id="favcount_{{ $event->EventId }}"></span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            <ul class="list-inline">
                               <li>{{ $event->ShortName }}</li>
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{ url('event/'.$event->ShortName.'/') }}"  class="view-btn">
              View Event
          </span>
            </a>
       </div>
   </div>
               @endforeach
               
             </div>
              <center>
               @if($search_term == '')
 <a href="{{ url('events') }}"><button class="btn btn-primary">View All Results</button></a>
 @else
 <a href="{{ url('search/events/?search_term='.$search_term) }}"><button class="btn btn-primary">View All Results</button></a>
 @endif
</div>
@endif
</center>
<div class="clearfix">
  @if( count($users) > 0 )
                  <h4 style="border-bottom:1px solid #eeeeee;">Search Results For Users</h4>
                @foreach($users as $user)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                       <img id="image_{{ $user->UserId }}" src="{{ url('public/images/instructor.jpg') }}"/>
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange" onclick="manageFavourites('{{ url('managefavourites/user/'.$user->UserId.'/'.Session::get('user_id')) }}','{{ $user->UserId }}')">
                        <span id="fav_{{ $user->UserId }}"><i class="fa fa-heart-o"></i></span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{ $user->UserName }}</span>

                       </div>
                       <div class="swim-lang">
                           <span id="favcount_{{ $user->UserId }}"></span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            
                       </div>

                    </div>
                </div>
          <a href="{{ url('user/'.$user->ShortName.'/') }}"  class="view-btn">
                View User
                </span>
            </a>
       </div>
   </div>
               @endforeach

             </div>
              <center>
               @if($search_term == '')
 <a href="{{ url('users') }}"><button class="btn btn-primary">View All Results</button></a>
 @else
 <a href="{{ url('search/users/?search_term='.$search_term) }}"><button class="btn btn-primary">View All Results</button></a>
 @endif
</div>
@endif
</center>
           <br/>
       </div>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- instructor preview code starts here -->
@endsection