@extends('layouts.main')

@section('content')
 @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<div class="container" style="background:#fff" id="main-code">
  <div class="container" id="user-form">
  <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6 register_form">
                    <form method="post" action="{{ url('updatepassword') }}">
                      {{csrf_field()}}
                      <center><h4 style="color:#46A6EA">Change Password</h4></center>
                     <div class="form-group">
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="8-15 characters" value="{{old('pass')}}" onchange="password('{{url('register')}}')" required>
                        <div id="password" style="color: red;display:none"><li>Invalid Password</li></div>
                    </div>
                    <div class="form-group">
                         <input type="password" class="form-control" id="c_password" name="c_password" placeholder="8-15 characters" value="{{ old('c_password')}}" required>
                        <div id="cpassword" style="color: red;display: none"><li>Invalid Confirm Password</li></div>
                        <div id="message"></div>
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="token" value="{{$token}}">
                    </div>

                    <div class="form-group">
                    <button type="submit" name="submit" id="change-pass" class="btn btn-primary butn col-xs-8 col-sm-11">Change Password</button><br><br>
                  </div>

                </form>
              </div>
  </div>
    </div>

@endsection
