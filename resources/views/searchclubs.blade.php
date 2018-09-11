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
                         <li role="presentation"><a href="{{url('search/all/?search_term='.$search_term)}}" aria-controls="mainall" role="tab">ALL</a></li>
                       <li role="presentation"><a href="{{ url('search/events/?search_term='.$search_term) }}" aria-controls="mainevents" role="tab">EVENTS</a></li>
                       <li role="presentation" class="active"><a href="{{ url('search/clubs/?search_term='.$search_term) }}" aria-controls="mainclubs" role="tab">CLUBS</a></li>
                       <li role="presentation"><a href="{{ url('search/venues/?search_term='.$search_term) }}" aria-controls="mainvenues" role="tab">VENUES</a></li> 
                       <li role="presentation"><a href="{{ url('search/instructors/?search_term='.$search_term) }}" aria-controls="maininstructors" role="tab">INSTRUCTORS</a></li>
                          <li role="presentation"><a href="{{ url('search/users/?search_term='.$search_term) }}" aria-controls="mainusers" role="tab">USERS</a></li>
                       </ul>
           
   <div class="tab-content preview_details">
<div class="tab-content">
     <div role="tabpanel" class="tab-pane active img-shadow" id="mainclubs">
           <div class="clearfix">
               @if ( count($clubs) > 0)
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
               @else
               <h4>No Clubs Available</h4>
               @endif
               </div>
         
           
           @if(count($clubs)>0)
 <div class="text-center">
   <ul class="pagination">
{{ $clubs->links() }}
 </ul>
 </div>
</div>
@endif
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
@endsection