@extends('layouts.main')
@section('content')
 <script src='https://www.google.com/recaptcha/api.js'></script>

        <div class="container">
       <div class="row1">
          @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin-left:13px;text-align: center">
    {!! session('message.content') !!}
    </div>
@endif
</div>
<div class="container" id="main-code">
    <h5 style="background-color:#46A6EA;color:#fff;"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button>Contact Us</h5>
    <div class="col-sm-12">
    <div class="form-horizontal">
    	<div class="col-sm-offset-1 col-sm-10">
    <div class="form-horizontal">
    <form action="{{ url('contactus') }}" method="post">
    {{csrf_field()}}
    <div class="form-group">
      <label class="control-label col-sm-1" for="txt"> Name:  </label>
      <div class="col-sm-11">
        @if(Session::has('user_name'))
        <input type="text" class="form-control" id="txt" name="name" value="{{ Session::get('user_name') }}"   readonly>
        @else
        <input type="text" class="form-control" id="txt" name="name" value="{{ old('name') }}"   >
        @endif

      </div>
      </div>
     <div class="form-group">
      <label class="control-label col-sm-1" for="txt">Email: </label>
      <div class="col-sm-11">
        @if(Session::has('user_email'))
        <input type="text" class="form-control" id="txt" name="email" value="{{ Session::get('user_email') }}"   readonly>
        @else
        <input type="text" class="form-control" id="txt" name="email" value="{{ old('email') }}"  >
        @endif
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-1" for="txt">Subject: </label>
      <div class="col-sm-11">
         <textarea class="form-control" rows="1" name="subject" required>{{ old('subject') }}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-1" for="txt">Message: <span class="title-counter"></span></label>
      <div class="col-sm-11">
         <textarea class="form-control" id="message" rows="20" name="message" required>{{ old('message') }}</textarea>
      </div>
    </div>

 </div>
   <div class="form-group">
       <div class="col-sm-offset-10" >
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
   </div>

</form>
  </div>
</div>
</div>
</div></div></div>
@endsection