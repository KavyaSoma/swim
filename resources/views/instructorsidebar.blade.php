@foreach($instructors as $instructor)
<div class="col-sm-3">
  @if($instructor->Image == 'NA')
  
 <img style="width:100%" class="img-rounded profile_image" src="http://localhost/swim/public/images/venue.jpg"/>

  @else
  
  <img  style="width:100%" class="img-rounded profile_image" src="http://localhost/swim/public/images/venue.jpg" alt="Profile image"/>

@endif
  <div class="row">
      
    <div class="col-sm-12 col-xs-12" style="margin-top:5%;">
		<p> Qualification: <b>Frent Strock Swiming</b></p>
       <p>Experience<a href="#"> <b style="color:#000"> {{$instructor->Experience}} yrs</b></a></p>
       
	   
    </div>
    <div class="col-sm-12 col-xs-12" style="color:#46A6EA;">
      
    </div>
   @endforeach
       <br><br>


 </div>


</div>