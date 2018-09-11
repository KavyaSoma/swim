@extends('layouts.main')
@section('content')
 <div id="row1">
        @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="width:380px;">
    {!! session('message.content') !!}
    </div>
@endif
<div class="container" style="background:#fff" id="main-code">
  <div class="container" id="user-form">
  <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6 register_form">
                    <form method="post" action="{{ url('updatepassword') }}">
                      {{csrf_field()}}
                     <h4 style="color:black">Please Enter your mail to continue</h4>
                     <div class="form-group">
                      <input type="text" class="form-control" id="txt" placeholder="Your Mail" name="email" id="textbox" required>
                        <input type="hidden" name="name" value="{{ $name }}">
                    <input type="hidden" name="image" value="{{ $image }}">
                       </div>
                    <div class="form-group">
                    <button type="submit" name="submit" id="change-pass" class="btn btn-primary butn col-xs-8 col-sm-11">Login</button><br><br>
                  </div>

                </form>
              </div>
  </div>
    </div>
 </div>
@endsection
