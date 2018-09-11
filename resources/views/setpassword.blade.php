@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
      <!-- Registration code starts here -->
<div class="container" style="background:#fff" id="main-code">
  <div class="container" id="user-form">
  <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6 register_form">
  
                    <form action="{{url('confirmpassword/'.$id)}}" method="post">
                    {{csrf_field()}}
                      <center><h4 style="color:#46A6EA">Set Password</h4></center>
                   
                    <div class="form-group">
                        <label for="pwd">New Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Create Password" name="pass">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Create Password" name="c_password">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary butn col-xs-8 col-sm-11">Change Password</button><br><br>
                  </div>

                </form>

              </div>
  </div>
    </div>
      <!-- Registration code ends here -->

<!-- footer starts here -->
@endsection