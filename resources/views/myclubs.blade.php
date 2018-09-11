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
      <li><a href="{{url('/clubs')}}">All Clubs</a></li>
      <li class="active"><a href="javascript:;">My Clubs</a></li>
    </ul>
    @if( count($clubs)>0 )
    <br/>
    @foreach($clubs as $club)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                       <img id="image_{{ $club->ClubId }}" src="{{ url('public/images/clubs.jpg') }}"/>
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
               @else
               <h4>No Clubs Available</h4>
               @endif
               @if(count($clubs)>0)
                    <div class="row text-center">
                      <div class="col-lg-12">
                        <ul class="pagination">
                          {{ $clubs->links() }}
                        </ul>
                      </div>
                    </div>
                    @endif
             </div>
             <script>
             @foreach($clubs as $club)
             console.log('{{ url('getimages/club/'.$club->ClubId) }}');
             $.ajax({
                 url: '{{ url('getimages/club/'.$club->ClubId) }}',
                 success: function(html) {
                   if(html=="no") {
                   } else {
                     console.log(html);

                       $('#image_'+{{$club->ClubId}}).attr("src",html);
                   }
                 },
                 async:true
               });
                               console.log('{{ url('getfavourites/club/'.$club->ClubId.'/'.Session::get('user_id')) }}');
                               $.ajax({
                                   url: '{{ url('getfavourites/club/'.$club->ClubId.'/'.Session::get('user_id')) }}',
                                   success: function(html) {
                                     if(html=="no") {
                                     } else {
                                         var temp = new Array();
                                         temp = html.split(",");
                                         console.log(temp[0]);
                                         if(temp[0] == 'yes') {
                                           $('#fav_'+{{$club->ClubId}}).html('<i class="fa fa-heart">');
                                         } else {
                                           $('#fav_'+{{$club->ClubId}}).html('<i class="fa fa-heart-o">');
                                         }
                                         $('#favcount_'+{{$club->ClubId}}).text(temp[1]+' Favourites');
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