@extends('layouts.main')
@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger }}"  style="margin:13px;text-align: center;">
        {{ $error }}
        </div>
    @endforeach
@endif
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif

<div class="container" style="background:#fff" id="main-code">
  <div class="container" id="user-form">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 register_form">
                    <form method="post" action="{{ url('register') }}" id="register-form">
                      {{csrf_field()}}
                      <div class="form-group">

                           <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{old('email')}}" onblur="registermail('{{url('/checkmail')}}')"  required>
                           <div id="error-email" style="color:red;display: none">Email Already exists</div>
                      </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="UserName 2 to 25 characters" value="{{old('username')}}" required>
                         <div class="error-list" style="color: red"></div>

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password 8-15 characters" value="{{old('password')}}" onchange="password('{{url('register')}}')" required>
                        <div id="pass" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirm_password" name="c_password" placeholder="Password 8-15 characters" value="{{ old('password')}}" required>
                        <div id="cpass" style="color: red;"></div>
                        <div id="message"></div>
                    </div>
                    <div class="form-group">
                      <select class="form-control" id="user_type" name="user_type" required>
                         <option>Select User Type</option>
                        <option value="user">User</option>
                        <option value="instructor">Instructor</option>
                        <option value="venue">Venue Admin</option>
                        <option value="club">Club Admin</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="display" name="shortname" placeholder="Public Name" value="{{old('shortname')}}" readonly>
                    </div>
                    <div class="form-group">
                    <button type="submit"  class="btn btn-primary butn col-xs-8 col-sm-11" id="register" onclick="register()">Sign Up</button><br><br>
                  </div>
                  <p>Already Existing User? <a href="{{ url('login') }}" style="color:#46A6EA"><b>Login Here</b></a></p>
                </form>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div>
          <a href="{{url('facebooklogin')}}"><button class="btn btn-default butn col-sm-12 facebook"><i class="fa fa-facebook-square"></i> Sign In with facebook</button></a>
        </div><hr class="mob-none">
                  <center><p class="mob-none" style="text-align:center"><b>OR</b></p>
                      <div>
                   <a href="{{ url('googlelogin') }}"> <button class="btn btn-default butn col-sm-12 google"><i class="fa fa-google-plus"></i> Sign In with google</button></a>
                  </div><hr class="mob-none">
                  <center><p class="mob-none" style="text-align:center"><b>OR</b></p>
                  <div>
                      <a href="{{ url('twitterlogin') }}"><button class="btn btn-default butn col-sm-12 twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button></a>
              </div>
        </div>
      </div>
    </div>
    <script>
    </script>
@endsection
