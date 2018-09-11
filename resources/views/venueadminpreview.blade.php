@extends('layouts.main')
@section('content')
      <!-- venue admin code starts here -->
<div class="container" id="main-code">
     <div class="fb-profile">
         <img align="left" class="fb-image-lg" src="images/swimm2.jpg" alt="cover image"/>
         <img align="left" class="fb-image-profile thumbnail" src="images/sravan.jpeg" alt="Profile image"/>
     <div class="fb-profile-text">
         <h3>Sravan</h3>
         <p>Venue Admin</p>
        <hr>
      <center>
        <div class="row">
          <div class="col-sm-2  col-xs-4 followers">
          <p>Followers <a href="#"><span class="badge">50</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 following ">
              <p>Following <a href="#"><span class="badge">70</span></a></p>
            </div>
            <div class="col-sm-2 col-xs-4 members ">
              <p>Events <a href="#"><span class="badge">30</span></a></p>
            </div>
          </div>
  </div>
  <hr>
  <div class="container" style="margin-top:20px;background-color:#fff">
    <ul class="nav nav-tabs preview_tabs">
         <li class="active"><a data-toggle="tab" href="#venueadminpreview-basic"> <i class="fa fa-info" aria-hidden="true" id="info_fa"></i> Basic Details</a></li>
       <li><a data-toggle="tab" href="#venueadminpreview-address"> <i class="fa fa-map-marker" aria-hidden="true" id="info_fa"></i> Address</a></li>
          <li><a data-toggle="tab" href="#venueadminpreview-contact"> <i class="fa fa-phone" aria-hidden="true" id="info_fa"></i> Contact</a></li>

        <button class="btn btn-primary pull-right mob-none">Edit</button>
  </ul>
  <div class="tab-content preview_details">
      <div id="venueadminpreview-basic" class="tab-pane fade in active">
          <form class="form-horizontal">
              <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
          <div>
                <h4 class="field_names">Admin Name</h4></div>
                   <p>Sravan</p>
                  <hr>
                    <div>
                             <h4 class="field_names">Gender</h4></div>
                 <p>male</p><hr>
                 <div>
                    <h4 class="field_names">Date Of Birth</h4></div>
         <p>01-01-1990</p>
       </div>
     </form>
   </div>

         <div id="venueadminpreview-address" class="tab-pane fade">
           <form class="form-horizontal">
             <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
              <div>
                    <h4 class="field_names">Address</h4></div>
                 <p>Box 777,91 Western Road,Brighton.</p><hr>
                 <div>
                   <h4 class="field_names">City</h4></div>
                 <p>East Sussex</p><hr>
                 <div>
                    <h4 class="field_names">Post Code</h4></div>
                 <p> 232480</p><hr>
                 <div>
                    <h4 class="field_names">Town</h4></div>
                 <p> UK,BN1 2NW</p><hr>
              <div>
                    <h4 class="field_names">Country</h4></div>
                 <p> UK,BN1 2NW</p>
               </div>
             </form>
           </div>
                  <div id="venueadminpreview-contact" class="tab-pane fade">
                     <form class="form-horizontal">
                       <div class="col xs-12 col-sm-12 col-md-12 col-lg-12">
                         <div>
                   <h4 class="field_names">Mobile</h4></div>
                 <p>1234567890</p><hr>
                 <div>
                    <h4 class="field_names">Email</h4></div>
                 <p>sravan.sharma@gmail.com</p><hr>
                 <div>
                    <h4 class="field_names">Web</h4></div>
                 <p>swimmiq.com</p>
</div>
</form>
</div>
</div>
<br><br>
</div>
</div>
</div>
<!-- venue admin code ends here -->
@endsection