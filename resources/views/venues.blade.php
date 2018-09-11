@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
    <div class="container" id="main-code">
    <br/>
    <ul class="nav nav-tabs preview_tabs">
      <li class="active"><a href="javascript:;">All Venues</a></li>
      <li><a href="{{url('/myvenues')}}">My Venues</a></li>
    </ul>
    @if( count($venues)>0 )
    <center>
      <form action="{{ url('venues') }}" method="post">
        {{ csrf_field() }}
      <div class="search">
          <div class="input-group">
             <div class="input-group-btn search-bar">
               @if($show_count == "no")
               <input type="text" name="venue" placeholder="Type Venue name and hit Enter key" id="search-input" value="{{ $search_term }}" class="form-control" required/>
               @else
               <input type="text" name="venue" placeholder="Type Venue name and hit Enter key" id="search-input" class="form-control" required/>
               @endif
              </div>
              <div class="input-group-btn search-submit">
              </div>
          </div>
      </div>
    </form>
    </center>
    <br/>
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
               @else
               <h4>No Venues Available</h4>
               @endif
               @if(count($venues)>0)
                    <div class="row text-center">
                      <div class="col-lg-12">
                        <ul class="pagination">
                          {{ $venues->links() }}
                        </ul>
                      </div>
                    </div>
                    @endif
             </div>
             <script>
             @foreach($venues as $venue)
             console.log('{{ url('getimages/venue/'.$venue->VenueId) }}');
             $.ajax({
                 url: '{{ url('getimages/venue/'.$venue->VenueId) }}',
                 success: function(html) {
                   if(html=="no") {
                   } else {
                     console.log(html);

                       $('#image_'+{{$venue->VenueId}}).attr("src",html);
                   }
                 },
                 async:true
               });
                               console.log('{{ url('getfavourites/venue/'.$venue->VenueId.'/'.Session::get('user_id')) }}');
                               $.ajax({
                                   url: '{{ url('getfavourites/venue/'.$venue->VenueId.'/'.Session::get('user_id')) }}',
                                   success: function(html) {
                                     if(html=="no") {
                                     } else {
                                         var temp = new Array();
                                         temp = html.split(",");
                                         console.log(temp[0]);
                                         if(temp[0] == 'yes') {
                                           $('#fav_'+{{$venue->VenueId}}).html('<i class="fa fa-heart">');
                                         } else {
                                           $('#fav_'+{{$venue->VenueId}}).html('<i class="fa fa-heart-o">');
                                         }
                                         $('#favcount_'+{{$venue->VenueId}}).text(temp[1]+' Favourites');
                                     }
                                   },
                                   async:true
                                 });
              @endforeach
              function manageFavourites(aurl,cid) {
                console.log(aurl);
                $.ajax({
                    url: aurl,
                    success: function(html) {
                      console.log(html);
                      if(html == 'yes') {
                            $('#fav_'+cid).html('<i class="fa fa-heart">');
                          } else {
                            $('#fav_'+cid).html('<i class="fa fa-heart-o">');
                          }
                      },
                    async:true
                  });
              }
             </script>
@endsection
