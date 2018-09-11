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
      <li class="active"><a href="javascript:;">All Events</a></li>
      <li><a href="{{url('/eventsdashboard')}}">My Events</a></li>
    </ul>    
    @if( count($events)>0 )
    <center>
      <form action="{{ url('events') }}" method="post">
        {{ csrf_field() }}
      <div class="search">
          <div class="input-group">
             <div class="input-group-btn search-bar">
               @if($show_count == "no")
               <input type="text" name="event" placeholder="Type event name and hit Enter key" id="search-input" value="{{ $search_term }}" class="form-control" required/>
               @else
               <input type="text" name="event" placeholder="Type event name and hit Enter key" id="search-input" class="form-control" required/>
               @endif
              </div>
              <div class="input-group-btn search-submit">
              </div>
          </div>
      </div>
    </form>
    </center>
    <br/>
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
               @else
               <h4>No Clubs Available</h4>
               @endif
               @if(count($events)>0)
                    <div class="row text-center">
                      <div class="col-lg-12">
                        <ul class="pagination">
                          {{ $events->links() }}
                        </ul>
                      </div>
                    </div>
                    @endif
             </div>
             <script>
             @foreach($events as $event)
             console.log('{{ url('getimages/event/'.$event->EventId) }}');
             $.ajax({
                 url: '{{ url('getimages/event/'.$event->EventId) }}',
                 success: function(html) {
                   if(html=="no") {
                   } else {
                     console.log(html);

                       $('#image_'+{{$event->EventId}}).attr("src",html);
                   }
                 },
                 async:true
               });
                               console.log('{{ url('getfavourites/event/'.$event->EventId.'/'.Session::get('user_id')) }}');
                               $.ajax({
                                   url: '{{ url('getfavourites/event/'.$event->EventId.'/'.Session::get('user_id')) }}',
                                   success: function(html) {
                                     if(html=="no") {
                                     } else {
                                         var temp = new Array();
                                         temp = html.split(",");
                                         console.log(temp[0]);
                                         if(temp[0] == 'yes') {
                                           $('#fav_'+{{$event->EventId}}).html('<i class="fa fa-heart">');
                                         } else {
                                           $('#fav_'+{{$event->EventId}}).html('<i class="fa fa-heart-o">');
                                         }
                                         $('#favcount_'+{{$event->EventId}}).text(temp[1]+' Favourites');
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
