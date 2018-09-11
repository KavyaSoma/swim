<!-- pool finder starts here -->
@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<div class="container">
<div class="row col-md-12 map-n">
                    <div class="col-md-12" style="padding-left:0px;width:99%;height:350px; position: relative; overflow: hidden;" id="map">
                      Google Map
                    </div>
                  </div>
                </div><br>
<div class="container">
  <div class="row">

                      <div class="col-md-3 col-xs-12 col-sm-4">

      <div class="well" style="min-height:380px;max-height:380px;height:380px">
         <form action="{{ url('poolfinder') }}" class="form-horizontal" id="pform" method="get">

  <div class="form-group">
    <div class="easy-autocomplete" style="width: 252px;">
      @if($show_values == 'yes')
        <input type="search" class="form-control" id="location-suggestions" name="location" value="{{ $location }}"  placeholder="Search Location" autocomplete="off" required>
      @else
        <input type="search" class="form-control" id="location-suggestions" name="location"  placeholder="Search Location" autocomplete="off" required>
      @endif
        <div class="easy-autocomplete-container" id="eac-container-provider-remote"><ul style="display: none;"></ul></div></div>
    <div class="input-group-btn">

    </div>
  </div>
  <div class="form-group">
    <center><button type="button" class="btn btn-primary" onClick="initGeolocation()"><i class="fa fa-map-marker"></i> Use My Location</button></center>
    <input type="hidden" name="latitude" id="latitude" value="{{ $latitude }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ $longitude }}">
    <input type="hidden" name="switch" id="switch" value="{{ $switch }}">
  </div>
  <div class="form-group">
           <label class="control-label" style="color:#46A6EA;"> Distance </label>
           <div class="range range-color">
            @if($show_values == 'yes')
            <input type="range" name="range" min="1" max="100" value="{{$distance}}" onchange="rangecolor.value=value">
            <output id="rangecolor">{{$distance}}</output>
            @else
            <input type="range" name="range" min="1" max="100" value="10" onchange="rangecolor.value=value">
            <output id="rangecolor">10</output>
            @endif
          </div>
      </div>
      <div class="form-group">
            <label for="location1" class="control-label"  style="color:#46A6EA;">Sort By</label>
            <select class="form-control"  id="location1" name="sort">
              @if($show_values == 'yes')
              <option value="favCount" @if($sort == 'favCount')selected @endif>Favourites</option>
              <option value="distance" @if($sort == 'distance')selected @endif>Distance</option>
              @else
              <option value="favCount">Favourites</option>
              <option value="distance">Distance</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="type1" class="control-label"  style="color:#46A6EA;">Filter By</label>
            <select class="form-control"  id="type1" name="filter">
              <option value="Gym" @if($sort == 'Gym')selected @endif>Fitness</option>
              <option value="Parking" @if($sort == 'Parking')selected @endif>Parking</option>
              <option value="ParaSwimmingFacilities" @if($sort == 'ParaSwimmingFacilities')selected @endif>Physically Disabled</option>
              <option value="Diving" @if($sort == 'Diving')selected @endif>Diving</option>
              <option value="SwimForKids" @if($sort == 'SwimForKids')selected @endif>Swim For Kids</option>
              <option value="VisitingGallery" @if($sort == 'VisitingGallery')selected @endif>Visiting Gallery</option>
              <option value="PrivateHire" @if($sort == 'PrivateHire')selected @endif>Private Hire</option>
              <option value="Toilets" @if($sort == 'Toilets')selected @endif>Toilets</option>
              <option value="LadiesOnlySwimming" @if($sort == 'LadiesOnlySwimming')selected @endif>Ladies Only Swimming</option>
              <option value="Teachers" @if($sort == 'Teachers')selected @endif>Teachers</option>
              <option value="Shower" @if($sort == 'Shower')selected @endif>Shower</option>
            </select>
          </div>
          <div class="form-group">
          <button class="btn btn-warning" type="submit">Apply Filters</button>
          </div>
          </form>
      </div>
    </div>

    @if( count($venues)>0 )

    @foreach($venues as $venue)
    <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="javascript:;">
                    <div class="book-img-thumb">
                       <img id="image_{{ $venue->VenueId }}" src="{{ url('public/images/venue.jpg') }}"/>
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
                              @if($venue->Gym == 'yes')
                               <li>Fitness</li>
                              @endif
                              @if($venue->Parking == 'yes')
                               <li>Parking</li>
                              @endif
                              @if($venue->ParaSwimmingFacilities == 'yes')
                               <li>Physically Disabled</li>
                              @endif
                              @if($venue->Diving == 'yes')
                               <li>Diving</li>
                              @endif
                              @if($venue->SwimForKids == 'yes')
                               <li>Swim For Kids</li>
                              @endif
                              @if($venue->VisitingGallery == 'yes')
                               <li>Visiting Gallery</li>
                              @endif
                              @if($venue->PrivateHire == 'yes')
                               <li>Private Hire</li>
                              @endif
                              @if($venue->Toilets == 'yes')
                               <li>Toilets</li>
                              @endif
                              @if($venue->LadiesOnlySwimming == 'yes')
                               <li>Ladies Only Swimming</li>
                              @endif
                              @if($venue->Teachers == 'yes')
                               <li>Teachers</li>
                              @endif
                              @if($venue->Shower == 'yes')
                               <li>Shower</li>
                              @endif
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{ url('venue/'.$venue->ShortName) }}" class=" btn btn-primary delete_button col-xs-12 col-sm-12">
                 View Venue

               </span>
           </a>
              
          </span>
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
</div>
<!-- pool finder code ends here -->
<script>
function initGeolocation() {

                if (navigator.geolocation) {
                    // Call getCurrentPosition with success and failure callbacks
                    navigator.geolocation.getCurrentPosition(success, fail);
                } else {
                    alert("Sorry, your browser does not support geolocation services.");
                }
            }

            function success(position) {
                //window.location.replace("?mylocation&lt=" + position.coords.latitude + "&lo=" + position.coords.longitude);
                $("#longitude").val(position.coords.longitude);
                $("#latitude").val(position.coords.latitude);
                $("#switch").val("1");
                $("#pform").submit();
            }

            function fail() {
                alert('oh, browser failed to retrive location');
                // Could not obtain location
            }
function myMap() {
  var myCenter = new google.maps.LatLng({{ $latitude }},{{ $longitude }});
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 9};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
  {{ $multiplemarkers }}
}
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
$(document).ready(function() {
        					var options = {
        						url: function(phrase) {
        							return "{{ url('locationsuggestions/') }}/"+phrase;
        						},

        						getValue: "location"
        					};
                  $("#longitude").val(0);
                  $("#latitude").val(0);
                  $("#switch").val("0");
                  $("#location-suggestions").easyAutocomplete(options);
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDBor5xpZLlmlUStxG4ggyI9gvYYBhxRg&callback=myMap"></script>
@endsection
