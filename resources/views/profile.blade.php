@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
  <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
  {!! session('message.content') !!}
  </div>
  @endif
<!-- settings information code starts here -->
<div class="container" id="main-code">
   <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2" id=kin_photo>
    @if($users[0]->Image == "NA")
   <div class="fb-profile"  style="margin-top:21%">
<img class="thumbnail user_image"  src="{{url('public/images/profile.png')}}" width="200px" height="190px" alt="Profile image"/>
</div>
@else
<div class="fb-profile"  style="margin-top:21%">
<img class="thumbnail user_image"  src="{{$users[0]->Image}}" width="200px" height="190px" alt="Profile image"/>
</div>
@endif
<a href="{{url('editprofile')}}"><button class="btn btn-primary mybtn">Edit</button></a>
</div>
<div class="col-xs-12 col-sm-6 col-md-10" id="kin_info">
<form class="form-horizontal kin_info">

     <div class="well" style="background:#fff">
       <div class="container">
       <div class="row" style="width:73%">
         @if($users[0]->UserType == "user")
         <ul class="nav nav-tabs preview_tabs">
         <li class="active"><a href="{{url('profile')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Account Settings</a></li>
         <li><a href="{{url('kindetails')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Kin details</a></li>
         <li><a href="{{url('changeemail')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Change Password</a></li>
    </ul>
    @else
     <ul class="nav nav-tabs preview_tabs">
             <li class="active"><a data-toggle="tab" href="#accountsettings"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Account Settings</a></li>
             <li><a href="{{url('changeemail')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Change Password</a></li>             </ul>

           </ul>
           @endif

       <div class="tab-content preview_details">

        <div id="accountsettings" class="tab-pane fade in active">
           <form class="form-horizontal">
            @if(count($users)>0)
              <div class="col xs-12 col-sm-6 col-md-4 col-lg-4">
                <div>
                 <h4 class="field_names">UserName</h4></div>
                 <p>{{$users[0]->UserName}}</p>
                <br>
              <div>
                 <h4 class="field_names">Email</h4></div>
                     <p>{{$users[0]->Email}}</p>
                    <br>

                   <div>
                        <h4 class="field_names">User Type</h4></div>
                        <p>{{$users[0]->UserType}}</p>
                       <br>
                <div>
                  <h4 class="field_names">Mobile</h4></div>
                  <p>{{$users[0]->DayTimePhone}}</p>
                 <br>
                 <div>
                     <h4 class="field_names">Facebook</h4></div>
                     <p>{{$users[0]->Facebook}}</p><br>

                       <div>
                          <h4 class="field_names">Landline</h4></div>
                          <p>{{$users[0]->EveningPhone}}</p>
                         <br>
                </div>
                   @else
                     <div class="col xs-12 col-sm-6 col-md-4 col-lg-4">
                <div>
                 <h4 class="field_names">User Name</h4></div>
                 <p>NA</p>
                <br>
              <div>
                 <h4 class="field_names">Email</h4></div>
                     <p>NA</p>
                    <br>

                   <div>
                        <h4 class="field_names">User Type</h4></div>
                        <p>NA</p>
                       <br>
                <div>
                  <h4 class="field_names">Mobile</h4></div>
                  <p>NA</p>
                 <br>
                 <div>
                     <h4 class="field_names">Facebook</h4></div>
                     <p>NA</p><br>

                       <div>
                          <h4 class="field_names">Landline</h4></div>
                          <p>NA</p>
                         <br>
                </div>
                @endif
                @if(count($address)>0)
                   <div class="col xs-12 col-sm-6 col-md-4 col-lg-4">

                           <div>
                   <h4 class="field_names">Address</h4></div>
                   <p>{{$address[0]->AddressLine1}}</p>
                  <br>
                  <div>
                    <h4 class="field_names">Country</h4></div>
                    <p>{{$address[0]->Country}}</p>
                   <br>
                         <div>
                            <h4 class="field_names">City</h4></div>
                            <p>{{$address[0]->City}}</p>
                           <br>
                     <div>
                       <h4 class="field_names">Postcode</h4></div>
                       <p>{{$address[0]->PostCode}}</p>
                      <br>
                      <div>
                        <h4 class="field_names">Twitter</h4></div>
                        <p>{{$address[0]->Twitter}}</p><br>
                        <div>
                          <h4 class="field_names">Website</h4></div>
                          <p>{{$address[0]->Website}}</p><br>
                        </div>
                        @else
                        <div class="col xs-12 col-sm-6 col-md-4 col-lg-4">

                           <div>
                   <h4 class="field_names">Address</h4></div>
                   <p>NA</p>
                  <br>
                  <div>
                    <h4 class="field_names">Country</h4></div>
                    <p>NA</p>
                   <br>
                         <div>
                            <h4 class="field_names">City</h4></div>
                            <p>NA</p>
                           <br>
                     <div>
                       <h4 class="field_names">Postcode</h4></div>
                       <p>NA</p>
                      <br>
                      <div>
                        <h4 class="field_names">Twitter</h4></div>
                        <p>NA</p><br>
                        <div>
                          <h4 class="field_names">Website</h4></div>
                          <p>NA</p><br>
                        </div>
                        @endif
                      </form>

                    </div>
                </div>
              </div>
            </div>
          </div>
            </div>
        </div>
      </div>
              @endsection

<!-- kin information code ends here -->
