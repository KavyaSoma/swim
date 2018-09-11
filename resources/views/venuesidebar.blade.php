<div class="col-xs-12 col-sm-3">
  @if(count($venues)>0)
  @if($image[0]->ImagePath == 'NA')
       <img style="width:100%" src="{{ url('public/images/venue.jpg') }}"/>
  @else
      <img style="width:100%" src="{{ $image[0]->ImagePath }}"/>
  @endif
      <h5 style="color:#46A6EA">Venue Name</h5>
      <p>{{$venues[0]->VenueName}}</P>
        @if(count($address)>0)
      <i class="fa fa-map-marker" style="color:#46A6EA"></i> {{$address[0]->Country}}
      @endif
      @if(count($timings)>0)
      <h5 style="color:#46A6EA">Opening Hours</h5>
      @foreach($timings as $timing)
      <p>{{$timing->Day}}({{$timing->OpeningHours}} to {{$timing->ClosingHours}})<br>
        @endforeach
        @endif
      </p>

   <br>
	<div class="col-md-12 footer-social-icons">
<a href="https://twitter.com/{{$venues[0]->Twitter}}" class="myzommimg" target="blank" style="background:#76a9eb;"><i class="fa fa-twitter myzommimg" aria-hidden="true"></i></a>&nbsp;&nbsp;
<a href="https://www.facebook.com/{{$venues[0]->Facebook}}" class="myzommimg" target="blank" style="background:#23527c;"><i class="fa fa-facebook myzommimg" aria-hidden="true"></i></a>&nbsp;&nbsp;
<a href="#" class="myzommimg" target="blank" style="background:#f51c0b;"><i class="fa fa-google-plus myzommimg" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
</div>
    @endif
