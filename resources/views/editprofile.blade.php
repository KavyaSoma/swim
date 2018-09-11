  @extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- settings information code starts here -->
<form class="form-horizontal" action="{{url('editprofile')}}" method="post" style="background:#fff;padding:35px;" enctype="multipart/form-data">
 {{csrf_field()}}
<div class="container" id="main-code">
<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2" id=kin_photo>
@if($users[0]->Image=="NA")
<div class="fb-profile" id="uploadimage"  style="margin-top:21%">
<img class="thumbnail user_image"  src="{{url('public/images/profile.png')}}" width="200px" height="190px"  alt="Profile image"/>
<span class="btn btn-default" style="margin-top:-100px" onclick="imgupload()"><i class="fa fa-edit" aria-hidden="true" title="Edit Picture" id="fa_edit"></i></span>
<input type="file" id="profileImage" name="profileImage" style="display:none"  accept="image/*"/>
</div>
@else
<div class="fb-profile"  style="margin-top:21%">
<img class="thumbnail user_image"  src="{{$users[0]->Image}}" width="200px" height="190px" alt="Profile image"/>
<span class="btn btn-default" style="margin-top:-100px" onclick="imgupload()"><i class="fa fa-edit" aria-hidden="true" title="Edit Picture" id="fa_edit"></i></span>
 <input type="file" id="profileImage" name="profileImage" style="display:none"  accept="image/*"/>
</div>
@endif
</div>
<div class="col-xs-12 col-sm-6 col-md-10" id="kin_info">
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
<li class="active"><a href="{{url('profile')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Account Settings</a></li>
<li><a href="{{url('changeemail')}}"> <i class="fa fa-cog" aria-hidden="true" id="info_fa"></i> Change Password</a></li>
</ul>
@endif
<div class="tab-content preview_details">
<div id="accountsettings" class="tab-pane fade in active" style="margin-top:20px">

@if(count($users)>0)
<div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
<input type="hidden" name="AddressId" value="{{$users[0]->AddressId}}">
<div class="form-group">
<label class="control-label col-sm-4" for="txt">User Name:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="venue-name" name="UserName" value="{{$users[0]->UserName}}" pattern="([A-zÀ-ž\s]){3,25}">
<span class="error" style="color: red;display: none;">User Name Should contain only 5-25 characters</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Email:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" value="{{$users[0]->Email}}" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">User Type:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" value="{{$users[0]->UserType}}" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Mobile:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="venue-mobile" name="DayTimePhone" value="{{$users[0]->DayTimePhone}}" pattern="([0-9]){10}">
<span class="mobile-error" style="color: red;display: none;">Mobile number should contain 10 digits.</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Landline:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="landline" name="EveningPhone" value="{{$users[0]->EveningPhone}}">
<div class="landline-error" style="color: red"></div>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Facebook:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="Facebook" value="{{$users[0]->Facebook}}">
</div>
</div>
</div>
@else
<div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
<input type="hidden" name="AddressId" value="{{$users[0]->AddressId}}">
<div class="form-group">
<label class="control-label col-sm-4" for="txt">User Name:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="venue-name" name="UserName" value="{{$users[0]->UserName}}" pattern="([A-zÀ-ž\s]){3,25}">
<span class="error" style="color: red;display: none;">User Name Should contain only 5-25 characters</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Email:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" value="{{$users[0]->Email}}" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">User Type:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" value="{{$users[0]->UserType}}" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Mobile:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="venue-mobile" name="DayTimePhone" value="{{$users[0]->DayTimePhone}}" pattern="([0-9]){10}">
<span class="mobile-error" style="color: red;display: none;">Mobile number should contain 10 digits.</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Landline:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="landline" name="EveningPhone" value="{{$users[0]->EveningPhone}}">
<div class="landline-error"></div>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Facebook:</label>
<div class="col-sm-7">
<input type="url" class="form-control" id="txt" name="Facebook" value="{{$users[0]->Facebook}}">
</div>
</div>
</div>
@endif
@if(count($address)>0)
<div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Address:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="AddressLine1" value="{{$address[0]->AddressLine1}}">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">City</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="City" value="{{$address[0]->City}}">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="file">Postcode:</label>
<div class="col-sm-7">
<input type="text" class="form-control" name="PostCode" value="{{$address[0]->PostCode}}">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Country:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="country" name="Country" value="{{$address[0]->Country}}">
<div class="country-error" style="display: none;color: red">Country Name should contain only Alphabets.</div>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Twitter:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="Twitter" value="{{$address[0]->Twitter}}">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Website:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="Website" value="{{$address[0]->Website}}">
</div>
</div>
<button type="submit" class="btn btn-primary mybtn">Save and Continue</button>
</div>
@else
<div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Address:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="AddressLine1" value="NA">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">City</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="City" value="NA">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="file">Postcode:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="PostCode" value="NA">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Country:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="country" name="Country" value="NA">
<div class="country-error" style="display: none;color: red">Country Name should contain only Alphabets.</div>

</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Twitter:</label>
<div class="col-sm-7">
<input type="text" class="form-control" id="txt" name="Twitter" value="NA">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Website:</label>
<div class="col-sm-7">
<input type="url" class="form-control" id="txt" name="Website" value="NA">
</div>
</div>
<button type="submit" class="btn btn-primary">Save and Continue</button>
</div>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
<script>
function imgupload() {
$("#profileImage").click();
}
function coverupload() {
$("#coverImage").click();
}
</script>
<!-- kin information code ends here -->
@endsection
