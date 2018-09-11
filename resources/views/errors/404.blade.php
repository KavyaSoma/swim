<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>404</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="{{ asset('public/css/lib/bootstrap.min.css') }}" rel="stylesheet">
   <link  href="{{ asset('public/css/lib/swiper.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/css/lib/jquery.es-drawermenu.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/css/lib/style.min.css') }}">
   <link  href="{{ asset('public/css/lib/waves.css') }}" rel="stylesheet">
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
<script src="{{ asset('public/js/lib/jquery.min.js') }}"></script>
<style>
@import url(https://fonts.googleapis.com/css?family=Norican);
html, body {margin:0;background:#fff;}

.div {
  display:block;
  position:absolute;
  top:40%;
  left:50%;
  margin:-20px 0 0 -20px;
  width:40px;
  line-height:40px;
}
.h1 {
  font-size:50px;
  color:white;
  text-shadow:0 2px 0 #46A6EA;,2px 3px 15px rgba(0,0,0,0.5);
}
.ripple,.ripple:before,.ripple:after {
  display:block;
  border-radius:2px;
  width:2px;
  height:2px;
  -webkit-animation:rip 6s infinite ease-out;
  -moz-animation:rip 6s infinite ease-out;
}
.ripple {
  position:absolute;
  z-index:-1;
  top:40px;
  left:15px;
}
.ripple:before,.ripple:after {
  content:'';
  position:absolute;
}
.ripple:before {-webkit-animation-delay:.2s;-moz-animation-delay:.2s;top:5px;left:25px;}
.ripple:after {-webkit-animation-delay:.8s;-moz-animation-delay:.8s;top:25px;left:0;}
@-webkit-keyframes rip
{
  0%  {
    box-shadow:0 0 0 0 transparent,
               0 0 0 0 transparent,
               0 0 0 0 transparent,
               0 0 0 0 transparent;
  }
  15%  {
    box-shadow:0 0 0 0 #46A6EA,
               0 0 0 0 rgba(255,255,255,0.4),
               0 0 0 0 #46A6EA,
               0 0 0 0 rgba(0,0,0,0.08);
  }
  100% {
    box-shadow:0 0 40px 200px #46A6EA,
               0 0 10px 210px transparent,
               0 0 30px 220px #46A6EA,
               0 0 5px 230px transparent;
  }
}
@-moz-keyframes rip
{
  0%  {
    box-shadow:0 0 0 0 transparent,
               0 0 0 0 transparent,
               0 0 0 0 transparent,
               0 0 0 0 transparent;
  }
  15%  {
    box-shadow:0 0 0 0  #46A6EA,
               0 0 0 0 rgba(255,255,255,0.4),
               0 0 0 0 #46A6EA,
               0 0 0 0 rgba(0,0,0,0.08);
  }
  100% {
    box-shadow:0 0 40px 200px #46A6EA,
               0 0 10px 210px transparent,
               0 0 30px 220px #46A6EA,
               0 0 5px 230px transparent;
  }
}

</style>
</head>
 <body>
<!-- header Desktop -->
  <header>
      <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo" >
                    <a href="{{ url('/') }}">
                        <img src="{{url('public/images/logo.png')}}" />
                    </a>
                </div>
          </div>
        </div>
    </div>
        <div class="main-menu">
            <div class="container">
                <nav class="navigation">
                    
                    </nav>
            </div>
        </div>
    </header>
    <center>
      <div class="div">
   <h1 class="h1">404</h1>
   <span class="ripple"></span>
 </div>
        <h4>Go to <a href="{{ url('/') }}" style="color:#46A6EA;">Home page</a> or <a href="{{ url('search/all') }}" style="color:#46A6EA;">Search page</a></h4>

  <center>
<!-- footer starts here -->
<footer class="mob-none tab-none" style="bottom:0px;width:100%;position:fixed">
    <div class="footer-icons">
       <div class="container">
        <div class="clearfix">
              <div class="col-md-6 footer-social-icons pull-right padding-rr">
                <a href="#" target="blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#" target="blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" target="blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
              </div>
        </div>
    </div>
</div>
<div class="footer-links">
    <div class="container">
        <div class="clearfix">
            <div class=" col-md-2 footer-links-head">
                <h3><b>ABOUT US</b></h3>
                    <ul>
                        <li><a href="#">About</a></li>
                      <li><a href="#">How it works</a></li>
                    </ul>
            </div>
             <div class="col-md-2 footer-links-head">
                <h3><b>HELP</b></h3>
                    <ul>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Disclaimer</a></li>
                   </ul>
             </div>
             <div class="col-md-2 footer-links-head">
                <h3><b>Business</b></h3>
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
             </div>
             <div class="col-md-2 footer-links-head">
                <h3><b>Quick Links</b></h3>
                    <ul>
                      <li><a href="#">News</a></li>
                        <li><a href="#">Gallery</a></li>
                    </ul>
            </div>
          </div>
    </div>
</div>
  <div class="swimmiq-copyright">
            <div class="container">
                <div class="clearfix">
                    <div class="text-center">
                      <b><p class="pull-right">SWIMMIQ
                   <span style="color:#46A6EA">|</span> VONKDOTH PRODUCT</p></b>
                    </div>
                </div>
            </div>
    </div>
</footer>
<!-- footer ends here -->
<!-- responsive code starts here -->
<footer class="desk-none mob-block tab-block">
<div class="res-footer">
  <div class="container">
    <div class="row">
        <div class="swimmiq-copyright">
            <div class="text-center">
               <img src="images/mob/logo.png" alt="">
                <p>SWIMMIQ
              <span style="color:#46A6EA">|</span> VONKDOTH PRODUCT</p></b>
             </div>
        </div>
       </div>
    </div>
    </div>
</footer>
<!-- responsive code ends here -->
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
   </body>
</html>
