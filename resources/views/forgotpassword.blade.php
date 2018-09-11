@extends('layouts.main')
@section('content')

@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<div class="container" style="background:#fff">
  <div class="container" id="user-form">
  <div class="col-xs-12 col-sm-offset-3 col-sm-12 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6 forgot_form">
  <form method="post" action="{{ url('emailcheck') }}">
  	{{csrf_field()}}
      <div class="form-group">
                        <label for="txt">Email:</label>
                        <input type="email" class="form-control" id="txt" placeholder="Enter Username/email" name="email" required>
                    </div>

                    <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary butn col-xs-8 col-sm-11">Next</button><br><br><br>
                  </div>
                  <p><a href="{{ url('register') }}" style="color:#46A6EA"><b>Register</b></a> <span>|</span> <a href="{{ url('login') }}" style="color:#ff6600"><b>Login</b></a></p>
                </form>

            </div>

      </div>
    </div>

           <script src="js/lib/jquery.min.js"></script>
        <script src="js/lib/jquery-ui.min.js"></script>
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/lib/jquery.interpolate.min.js"></script>
        <script src="js/lib/jquery.coverflow.js"></script>
        <script src="js/lib/waves.min.js"></script>
        <script src="js/lib/reflection.js"></script>
        <script src="js/lib/masonry.pkgd.min.js"></script>
        <script src="js/lib/jquery.es-drawermenu.js"></script>
        <script src="js/app.js"></script>
        <script src="js/owl.carousel.min.js"></script>
  <script>
  	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:5,
	    nav:true,
	    // autoWidth:true,

	    navText: [" <span class='glyphicon glyphicon-chevron-left img-circle'></span>","<span class='glyphicon glyphicon-chevron-right img-circle'></span>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
          800:{
             items:2
         },
         1000:{
	            items:4
	        }
	    }
	})
  </script>
<script type="text/javascript">
$(document).ready(function() {
  $('.drawermenu').drawermenu({
    speed:100,
    position:'left'
  });
});
</script>

@endsection