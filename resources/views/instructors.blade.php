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
      <li class="active"><a href="javascript:;">All Instructors</a></li>
      <li><a href="{{url('/myinstructors')}}">My Instructors</a></li>
</ul>
    @if( count($instructors)>0 )
    <center>
      <form action="{{ url('instructors') }}" method="post">
        {{ csrf_field() }}
      <div class="search">
          <div class="input-group">
             <div class="input-group-btn search-bar">
               @if($show_count == "no")
               <input type="text" name="instructor" placeholder="Type Instructor name and hit Enter key" id="search-input" value="{{ $search_term }}" class="form-control" required/>
               @else
               <input type="text" name="instructor" placeholder="Type Instructor name and hit Enter key" id="search-input" class="form-control" required/>
               @endif
              </div>
              <div class="input-group-btn search-submit">
              </div>
          </div>
      </div>
    </form>
    </center>
    <br/>
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
               @else
               <h4>No Instructors Available</h4>
               @endif
               @if(count($instructors)>0)
                    <div class="row text-center">
                      <div class="col-lg-12">
                        <ul class="pagination">
                          {{ $instructors->links() }}
                        </ul>
                      </div>
                    </div>
                    @endif
             </div>
             <script>
             @foreach($instructors as $instructor)
             console.log('{{ url('getimages/instructor/'.$instructor->UserId) }}');
             $.ajax({
                 url: '{{ url('getimages/instructor/'.$instructor->UserId) }}',
                 success: function(html) {
                   if(html=="no") {
                   } else {
                     console.log(html);

                       $('#image_'+{{$instructor->UserId}}).attr("src",html);
                   }
                 },
                 async:true
               });
                               console.log('{{ url('getfavourites/instructor/'.$instructor->UserId.'/'.Session::get('user_id')) }}');
                               $.ajax({
                                   url: '{{ url('getfavourites/instructor/'.$instructor->UserId.'/'.Session::get('user_id')) }}',
                                   success: function(html) {
                                     if(html=="no") {
                                     } else {
                                         var temp = new Array();
                                         temp = html.split(",");
                                         console.log(temp[0]);
                                         if(temp[0] == 'yes') {
                                           $('#fav_'+{{$instructor->UserId}}).html('<i class="fa fa-heart">');
                                         } else {
                                           $('#fav_'+{{$instructor->UserId}}).html('<i class="fa fa-heart-o">');
                                         }
                                         $('#favcount_'+{{$instructor->UserId}}).text(temp[1]+' Favourites');
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
