function checkdates(f,s,i,b) {
 firstdate = $('#'+f).val();
 seconddate = $('#'+s).val();
 if(firstdate != '' && seconddate == '') {
    var dateToCompare = new Date(firstdate);
    var currentDate = new Date();

if (dateToCompare >= currentDate) {
    $('#'+i).text('');
}
else {
    $('#'+i).text('publish date should not be today or past dates');
    $('#'+b).attr("disabled", "disabled");
}
 } else if(firstdate == '' && seconddate != '') {
    var dateToCompare = new Date(seconddate);
    var currentDate = new Date();

if (dateToCompare >= currentDate) {
    $('#'+i).text('');
}
else {
    $('#'+i).text('expire date should not be today or past dates');
    $('#'+b).attr("disabled", "disabled");
}

 } else if(firstdate != '' && seconddate != '') {
  if (seconddate > firstdate) {
    $('#'+i).text('');
    $('#'+b).attr("disabled", false);
}
else {
    $('#'+i).text('expire date should not be lessthan publish date');
    $('#'+b).attr("disabled", "disabled");
}
 } 
}
function selectSearch() {
    console.log($('#search_select').val());
    var previous = $('#search_form').attr('action');
    var temp = previous.split('/search');
    console.log($('#search_form').attr('action'));
    $('#search_form').attr('action',temp[0]+'/search/'+$('#search_select').val());
    console.log($('#search_form').attr('action'));
}
function shortName() {
          var email = $('#email').val();
          var temp = new Array();
          temp = email.split("@");
          console.log(temp[0]);
          $('#display').val(temp[0]);
}
function input(url) {       
        $.post(
            'register',
            {
                username: $('#username').val(),
                _token: $('input[name="_token"]').val(),
             }
        ).always(function(data) {
          
          
          var username=$('#username').val();
          username =username.replace(/ +/g, ""); 
          //document.getElementById('display').value = username;
            var error = data.responseJSON;
            if(error) {
                $('.error-list').html('<li class="error">' + error.username[0] + '</li>');
                $('#username').parent().removeClass('pass');
                $('#username').parent().addClass('fail');
            } else {
              $('#username').removeClass('fail');
                 $('#username').parent().addClass('pass');
                $('.error-list').removeClass('show-error');
            }
        });
}

$('#password').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#password').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('#pass').show();
             }
           else{ 
                $('#pass').hide();
                 
               }
         });
});

$('#confirm_password').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#confirm_password').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('#cpass').show();
             }
            else{
                $('#cpass').hide();
                 
               }
         });
});

$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').hide();
  } else 
    $('#message').html('Password and Confirm Password didnot match').css('color', 'red');
});

$(document).ready(function() {
$(function() {
    $('#register').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=password]').keyup(function() {        
    if ($('#username').val() !=''&& 
    $('#email').val() != '' && 
    $('#password').val() != ''&&  
    $('#confirm_password').val() != ''&&  
    $('#user_type').val() != ''&& $('#password').val() == $('#confirm_password').val()) {
      
        $('#register').removeAttr('disabled');
    } else {
        $('#register').attr('disabled', 'disabled');
    }
});
});

$('#pass').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#pass').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
              // there is a mismatch, hence show the error message
                 $('#password').show();
             }
           else{ 
                // else, do not display message
                $('#password').hide();
                 
               }
         });
});

$('#c_password').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#c_password').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('#cpassword').show();
             }
           else{
                $('#cpassword').hide();
                 
               }
         });
});
$('#change-pass').attr('disabled', 'disabled');
$('#pass, #c_password').on('keyup', function () {
  $('#change-pass').attr('disabled', 'disabled');
  if ($('#pass').val() == $('#c_password').val()) {
    $('#change-pass').removeAttr('disabled');
    $('#message').hide();
  } else 
   $('#change-pass').attr('disabled', 'disabled');
    $('#message').html('Password and Confirm Password didnot match').css('color', 'red');
});


$(function() {
      $("#single").show();
      $("#multiple").hide();
      $(".recuring").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
  $("input[name='privacy']").click(function() {
    if ($("#one-occurance").is(":checked")) {
      $("#single").show();
      $("#multiple").hide();
      $(".recuring").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
    } else if($("#multiple-occurance").is(":checked")){
      $("#multiple").show();
      $("#single").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
      $(".recuring").hide();
    } else{
      $(".recuring").show();
      $("#single").hide();
      $("#multiple").hide();
      $("#recursion").hide();
    }
  });
});

$(function() {
  $("#week").click(function(){
      $("#weekdays").show();
      $("#monthdays").hide();
      $("#yeardays").hide();
  });
  $("#month").click(function(){
    $("#monthdays").show();
     $("#weekdays").hide();
      $("#yeardays").hide();
  });
   $("#year").click(function(){
     $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").show();
  });
});

$(function(){
  $("#sub-event").click(function(){
    
    $(".fields").append($("#add-event").html());
  });
});
 
$('#clubname').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#clubname').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error-club').show();
             }
           else{
                $('.error-club').hide();
                var club=$('#clubname').val();
        club =club.replace(/ +/g, ""); 
        document.getElementById('shortname').value = club;
               }
         });
});

$('#club-type').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-type').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error-type').show();
             }
           else{
                $('.error-type').hide();
                 
               }
         });
});
$('#club-city').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-city').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error').show();
             }
           else{
                $('.error').hide();
                 
               }
         });
});
$('#post-code').ready(function(){
   var $regexname=/^([0-9]{4,9})$/;
    $('#post-code').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.post-error').show();
             }
           else{
                $('.post-error').hide();
                 
               }
         });
});
$('#club-town').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-town').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.town-error').show();
             }
           else{
                $('.town-error').hide();
                 
               }
         });
});
$('#club-country').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-country').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.country-error').show();
             }
           else{
                $('.country-error').hide();
                 
               }
         });
});
$("#club-mobile").ready(function(){
  var $regexname = /^([0-9]{10})$/;
  $("#club-mobile").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.mobile-error').show();
    }
    else{
      $('.mobile-error').hide();
    }
  });
});

//Event
$("#event-name").ready(function(){
  var eventname=$('#event-name').val();
  eventname =eventname.replace(/ +/g, ""); 
  document.getElementById('short-name').value = eventname;
});
$("#sub-event").ready(function(){
  var $regexname=/^([a-zA-Z_ ]{5,25})$/;
  $("#sub-event").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error').show();
    }
    else{
       $('.error').hide();
    }
  });
});
$("#course").ready(function(){
var $regexname=/^([0-9]{2,10})$/;
$("#course").on('keypress keydown keyup',function(){
  if(!$(this).val().match($regexname)){
    $('.course-error').show();
  }
  else{
    $('.course-error').hide();
  }
});
});
$("#min-part").ready(function(){
var $regexname=/^([0-9]{1,3})$/;
$("#min-part").on('keypress keydown keyup',function(){
 if(!$(this).val().match($regexname)){
   $('.min-part-error').show();
 }
 else{
   $('.min-part-error').hide();
 }
});
});
$("#max-part").ready(function(){
 var $regexname=/^([0-9]{1,3})$/;
 $("#max-part").on('keypress keydown keyup',function(){
   var minpart = $("#min-part").val();
     var maxpart = $("#max-part").val();
   if(!$(this).val().match($regexname)){
     $("#save-subevent").attr('disabled','disabled');
     $('.max-part-error').show();
   }
   else{
     $("#save-subevent").removeAttr('disabled');
     $('.max-part-error').hide();
     
     if(minpart > maxpart){
        $("#save-subevent").attr('disabled','disabled');
       $('.participant-error').show();
     }
     else{
       $("#save-subevent").removeAttr('disabled');
       $('.participant-error').hide();
     }
   }
 });
});
$("#min-age").ready(function(){
var $regexname=/^([0-9]{1,2})$/;
$("#min-age").on('keypress keydown keyup',function(){
 if(!$(this).val().match($regexname)){
   $('.min-age-error').show();
 }
 else{
   $('.min-age-error').hide();
 }
});
});

$("#max-age").ready(function(){
var $regexname=/^([0-9]{1,2})$/;
$("#max-age").on('keypress keydown keyup',function(){
  var maxage = $("#max-age").val();
   var minage = $("#min-age").val();
 if(!$(this).val().match($regexname)){
   $('.max-age-error').show();
 }
 else{
   $('.max-age-error').hide();

     if(maxage < minage){
       $("#save-subevent").attr('disabled','disabled');
       $('.age-error').show();
     }
     else{
       $("#save-subevent").removeAttr('disabled');
       $('.age-error').hide();
     }
 }
});
});

$("#venue-name").ready(function(){
  $("#venue-name").on('keypress keydown keyup',function(){
    
        var venuename=$('#venue-name').val();
        venuename =venuename.replace(/ +/g, ""); 
        document.getElementById('venue-short-name').value = venuename;
      });
});

$("#pool-width").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#pool-width").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-width-error').show();
		}
		else{
			$('.pool-width-error').hide();
		}
	});
});
$("#pool-length").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#pool-length").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-length-error').show();
		}
		else{
			$('.pool-length-error').hide();
		}
	});
});
$("#shallow-end").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#shallow-end").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.shallow-end-error').show();
		}
		else{
			$('.shallow-end-error').hide();
		}
	});
});
$("#deep-end").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#deep-end").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.deep-end-error').show();
		}
		else{
			$('.deep-end-error').hide();
		}
	});
});
$("#pool-area").ready(function(){
	var $regexname = /^([0-9]{2,5})$/;
	$("#pool-area").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-area-error').show();
		}
		else{
			$('.pool-area-error').hide();
		}
	});
});

$("#venue-city").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,20})$/;
	$("#venue-city").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.city-error').show();
		}
		else{
			$('.city-error').hide();
		}
	});
});
$("#post-code").ready(function(){
	var $regexname = /^([0-9]{5,20})$/;
	$("#post-code").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.post-error').show();
		}
		else{
			$('.post-error').hide();
		}
	});
});
$("#town").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,25})$/;
	$("#town").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.town-error').show();
		}
		else{
			$('.town-error').hide();
		}
	});
});
$("#country").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,25})$/;
	$("#country").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.country-error').show();
		}
		else{
			$('.country-error').hide();
		}
	});
});
$("#venue-contact").ready(function(){
	var $regexname = /^([0-9]{7,15})$/;
	$("#venue-contact").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.contact-error').show();
		}
		else{
			$('.contact-error').hide();
		}
	});
});
$("#venue-mobile").ready(function(){
	var $regexname = /^([0-9]{10})$/;
	$("#venue-mobile").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.mobile-error').show();
		}
		else{
			$('.mobile-error').hide();
		}
	});
});
$("#start-one").change(function(){
		
	$("#start-one").on('keypress keydown keyup',function(){
   		var starttime=$('#start-one').val();
   		alert('ok');
        document.getElementById('display').value = starttime;
	});
});

$("#to_subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#to_subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.subject').show();
    }
    else{
      $('.subject').hide();
    }
  });
});
$(document).ready(function() {
$(function() {
    $('#dicard-message').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=email]').keyup(function() {        
    if ($('#email').val() !=''|| 
    $('#subject').val() != '' ||
    $('#message').val() != '') {
        $('#dicard-message').removeAttr('disabled');
    } else {
        $('#dicard-message').attr('disabled', 'disabled');
    }
});
});
$(document).ready(function() {
$(function() {
    $('#send-message').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=email]').keyup(function() {        
    if ($('#location-suggestions').val() !='' && 
    $('#to_subject').val() != '' &&
    $('#message').val() != '') {
        $('#send-message').removeAttr('disabled');
    } else {
        $('#send-message').attr('disabled', 'disabled');
    }
});
});
function uploadfile() {
  $("#attachment").click();
}
$(document).ready(function() {       
$('#attachment').bind('change', function() {
    var a=(this.files[0].size);
    $("#attachment-error").hide();
   // $("#max-size").html(a);
    if(a > 2000000) {
      $("#max-size").hide();
      $("#attachment-error").show();
       $('#send-message').attr('disabled', 'disabled');
    }
});
});
$("#reply-subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#reply-subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.replysubject').show();
    }
    else{
      $('.replysubject').hide();
    }
  });
});
function deletemsg(mid,url) {
  jQuery.ajax({
      url: url,
      success: function(html) {
       window.location.reload();
      },
      async:true
    });
}
function forward(subject,message){
  $("#reply-message").hide();
  $("#submit-reply").hide();
  $("#reply-reset").hide();
  $("#forwardmsg").show();
  $("#forward-subject").val(subject);
  $("#forward-message").html(message);
}
$("#forward-subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#forward-subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.forward-sub-error').show();
    }
    else{
      $('.forward-sub-error').hide();
    }
  });
});
function archive(url){
  jQuery.ajax({
      url: url,
      success: function(html) {
       window.location.reload();
      },
      async:true
    });
}

function addfriend(url){
  jQuery.ajax({
    url: url,
    success: function(html) {
      window.location.reload();
    },
    async:true
  })
}
function friends(url){
 jQuery.ajax({
    url: url,
    success: function(html) {
      window.location.reload();
    },
    async:true
  })
}

function deletenews(pid,url){
jQuery.ajax({
      url: url,
      success: function(html) {
       window.location.reload();
      },
      async:true
    });
}

function editnews(pid,message,sub,pdate,edate,status,type,link){
 $("#subject").val(sub);
 $("#publisheddate").val(pdate);
 $("#expireddate").val(edate);
 $("#description").html(message);
 $("#wesitelink").val(link);
 $("#news_id").val(pid);
 $("#mydropdownlist").val("thevalue").change();
}

$("#to_subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#to_subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.subject').show();
    }
    else{
      $('.subject').hide();
    }
  });
});
$(document).ready(function() {
$(function() {
    $('#dicard-message').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=email]').keyup(function() {        
    if ($('#email').val() !=''|| 
    $('#subject').val() != '' ||
    $('#message').val() != '') {
        $('#dicard-message').removeAttr('disabled');
    } else {
        $('#dicard-message').attr('disabled', 'disabled');
    }
});
});
$(document).ready(function() {
$(function() {
    $('#send-message').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=email]').keyup(function() {        
    if ($('#location-suggestions').val() !='' && 
    $('#to_subject').val() != '' &&
    $('#message').val() != '') {
        $('#send-message').removeAttr('disabled');
    } else {
        $('#send-message').attr('disabled', 'disabled');
    }
});
});
function uploadfile() {
  $("#attachment").click();
}
$(document).ready(function() {       
$('#attachment').bind('change', function() {
    var a=(this.files[0].size);
    $("#attachment-error").hide();
   // $("#max-size").html(a);
    if(a > 2000000) {
      $("#max-size").hide();
      $("#attachment-error").show();
       $('#send-message').attr('disabled', 'disabled');
    }
});
});
$("#reply-subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#reply-subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.replysubject').show();
    }
    else{
      $('.replysubject').hide();
    }
  });
});
function deletemsg(mid,url) {
  jQuery.ajax({
      url: url,
      success: function(html) {
       window.location.reload();
      },
      async:true
    });
}
function forward(subject,message){
  $("#reply-message").hide();
  $("#submit-reply").hide();
  $("#reply-reset").hide();
  $("#forwardmsg").show();
  $("#forward-subject").val(subject);
  $("#forward-message").html(message);
}
$("#forward-subject").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{3,100})$/;
  $("#forward-subject").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.forward-sub-error').show();
    }
    else{
      $('.forward-sub-error').hide();
    }
  });
});
function archive(url){
  jQuery.ajax({
      url: url,
      success: function(html) {
       window.location.reload();
      },
      async:true
    });
}

function input(url) {       
        $.post(
            'register',
            {
                username: $('#username').val(),
                _token: $('input[name="_token"]').val(),
             }
        ).always(function(data) {
          var username=$('#username').val();
        //username =username.replace(/ +/g, ""); 
        //document.getElementById('display').value = username;
            var error = data.responseJSON;
            if(error) {
                $('.error-list').html('<li class="error">' + error.username[0] + '</li>');
                $('#username').parent().removeClass('pass');
                $('#username').parent().addClass('fail');
            } else {
              $('#username').removeClass('fail');
                 $('#username').parent().addClass('pass');
                $('.error-list').removeClass('show-error');
            }
        });
}

function JoinVenue(VenueId,url) {

  jQuery.ajax({
      url: url,
      success: function(html) {
        $('#venue_'+VenueId).text(html);
      },
      async:true
    });

}


$('#password').ready(function(){
  var $regexname=/^([a-zA-Z0-9]{8,15})$/;
   $('#password').on('keypress keydown keyup',function(){
            if (!$(this).val().match($regexname)) {
                $('#pass').html("Password Should Contain atleast one Capital and one digit and between 8-15 characters in size");
            }
          else{
               $('#pass').hide();
               
              }
        });
});

$('#confirm_password').ready(function(){
  var $regexname=/^([a-zA-Z0-9]{8,15})$/;
   $('#confirm_password').on('keypress keydown keyup',function(){
            if (!$(this).val().match($regexname)) {
                $('#cpass').html("Password Should Contain atleast one Capital and one digit and between 8-15 characters in size");
            }
           else{
               $('#cpass').hide();
               
              }
        });
});

$('#password, #confirm_password').on('keyup', function () {
 if ($('#password').val() == $('#confirm_password').val()) {
   $('#message').hide();
 } else
   $('#message').html('Password and Confirm Password didnot match').css('color', 'red');
});

$(document).ready(function() {
$(function() {
    $('#register').attr('disabled', 'disabled');
}); 
$('input[type=text],input[type=password]').keyup(function() {        
    if ($('#username').val() !=''&& 
    $('#email').val() != '' && 
    $('#password').val() != ''&&  
    $('#confirm_password').val() != ''&&  
    $('#user_type').val() != ''&& $('#password').val() == $('#confirm_password').val()) {
      
        $('#register').removeAttr('disabled');
    } else {
        $('#register').attr('disabled', 'disabled');
    }
});
});

$('#pass').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#pass').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
              // there is a mismatch, hence show the error message
                 $('#password').show();
             }
           else{ 
                // else, do not display message
                $('#password').hide();
                 
               }
         });
});

$('#c_password').ready(function(){
   var $regexname=/^([a-zA-Z0-9]{8,15})$/;
    $('#c_password').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('#cpassword').show();
             }
           else{
                $('#cpassword').hide();
                 
               }
         });
});
$('#change-pass').attr('disabled', 'disabled');
$('#pass, #c_password').on('keyup', function () {
  $('#change-pass').attr('disabled', 'disabled');
  if ($('#pass').val() == $('#c_password').val()) {
    $('#change-pass').removeAttr('disabled');
    $('#message').hide();
  } else 
   $('#change-pass').attr('disabled', 'disabled');
    $('#message').html('Password and Confirm Password didnot match').css('color', 'red');
});


$(function() {
      $("#single").show();
      $("#multiple").hide();
      $(".recuring").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
  $("input[name='privacy']").click(function() {
    if ($("#one-occurance").is(":checked")) {
      $("#single").show();
      $("#multiple").hide();
      $(".recuring").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
    } else if($("#multiple-occurance").is(":checked")){
      $("#multiple").show();
      $("#single").hide();
      $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").hide();
      $(".recuring").hide();
    } else{
      $(".recuring").show();
      $("#single").hide();
      $("#multiple").hide();
      $("#recursion").hide();
    }
  });
});

$(function() {
  $("#week").click(function(){
      $("#weekdays").show();
      $("#monthdays").hide();
      $("#yeardays").hide();
  });
  $("#month").click(function(){
    $("#monthdays").show();
     $("#weekdays").hide();
      $("#yeardays").hide();
  });
   $("#year").click(function(){
     $("#weekdays").hide();
      $("#monthdays").hide();
      $("#yeardays").show();
  });
});

$(function(){
  $("#sub-event").click(function(){
    
    $(".fields").append($("#add-event").html());
  });
});
 
$('#clubname').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#clubname').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error-club').show();
             }
           else{
                $('.error-club').hide();
                var club=$('#clubname').val();
        club =club.replace(/ +/g, ""); 
        document.getElementById('shortname').value = club;
               }
         });
});

$('#club-type').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-type').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error-type').show();
             }
           else{
                $('.error-type').hide();
                 
               }
         });
});
$('#club-city').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-city').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.error').show();
             }
           else{
                $('.error').hide();
                 
               }
         });
});
$('#post-code').ready(function(){
   var $regexname=/^([0-9]{4,9})$/;
    $('#post-code').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.post-error').show();
             }
           else{
                $('.post-error').hide();
                 
               }
         });
});
$('#club-town').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-town').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.town-error').show();
             }
           else{
                $('.town-error').hide();
                 
               }
         });
});
$('#club-country').ready(function(){
   var $regexname=/^([a-zA-Z_ ]{3,25})$/;
    $('#club-country').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.country-error').show();
             }
           else{
                $('.country-error').hide();
                 
               }
         });
});
$("#club-mobile").ready(function(){
  var $regexname = /^([0-9]{10})$/;
  $("#club-mobile").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.mobile-error').show();
    }
    else{
      $('.mobile-error').hide();
    }
  });
});

//Event
$("#event-name").ready(function(){
  var $regexname=/^([a-zA-Z_ ]{5,25})$/;
  $("#event-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.name-error').show();
    }
    else{
       $('.name-error').hide();
        var eventname=$('#event-name').val();
        eventname =eventname.replace(/ +/g, ""); 
        document.getElementById('short-name').value = eventname;
    }
  });
});
$("#sub-event").ready(function(){
  var $regexname=/^([a-zA-Z_ ]{5,25})$/;
  $("#sub-event").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error').show();
    }
    else{
       $('.error').hide();
    }
  });
});
$("#course").ready(function(){
var $regexname=/^([0-9]{2,10})$/;
$("#course").on('keypress keydown keyup',function(){
  if(!$(this).val().match($regexname)){
    $('.course-error').show();
  }
  else{
    $('.course-error').hide();
  }
});
});
$("#min-part").ready(function(){
var $regexname=/^([0-9]{1,3})$/;
$("#min-part").on('keypress keydown keyup',function(){
  if(!$(this).val().match($regexname)){
    $('.min-part-error').show();
  }
  else{
    $('.min-part-error').hide();
  }
});
});
$("#max-part").ready(function(){
  var $regexname=/^([0-9]{1,3})$/;
  $("#max-part").on('keypress keydown keyup',function(){
    var minpart = $("#min-part").val();
      var maxpart = $("#max-part").val();
    if(!$(this).val().match($regexname)){
      $('.max-part-error').show();
    }
    else{
      $('.max-part-error').hide();
      
      if(minpart > maxpart){
        $('.participant-error').show();
      }
      else{
        $('.participant-error').hide();
      }
    }
  });
});

$("#venue-name").ready(function(){
	var $regexname=/^([a-zA-Z_ ]{5,25})$/;
  $("#venue-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error').show();
    }
    else{
       $('.error').hide();
        var venuename=$('#venue-name').val();
        venuename =venuename.replace(/ +/g, ""); 
        document.getElementById('venue-short-name').value = venuename;
    }
  });
});




$("#pool-name").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,25})$/;
	$("#pool-name").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-error').show();
		}
		else{
			$('.pool-error').hide();
		}
	});
});
$("#pool-width").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#pool-width").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-width-error').show();
		}
		else{
			$('.pool-width-error').hide();
		}
	});
});
$("#pool-length").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#pool-length").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-length-error').show();
		}
		else{
			$('.pool-length-error').hide();
		}
	});
});
$("#shallow-end").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#shallow-end").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.shallow-end-error').show();
		}
		else{
			$('.shallow-end-error').hide();
		}
	});
});
$("#deep-end").ready(function(){
	var $regexname = /^([0-9]{2,3})$/;
	$("#deep-end").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.deep-end-error').show();
		}
		else{
			$('.deep-end-error').hide();
		}
	});
});
$("#pool-area").ready(function(){
	var $regexname = /^([0-9]{2,5})$/;
	$("#pool-area").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.pool-area-error').show();
		}
		else{
			$('.pool-area-error').hide();
		}
	});
});

$("#venue-city").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,20})$/;
	$("#venue-city").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.city-error').show();
		}
		else{
			$('.city-error').hide();
		}
	});
});
$("#post-code").ready(function(){
	var $regexname = /^([0-9]{5,20})$/;
	$("#post-code").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.post-error').show();
		}
		else{
			$('.post-error').hide();
		}
	});
});
$("#town").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,25})$/;
	$("#town").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.town-error').show();
		}
		else{
			$('.town-error').hide();
		}
	});
});
$("#country").ready(function(){
	var $regexname = /^([a-zA-Z_ ]{5,25})$/;
	$("#country").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.country-error').show();
		}
		else{
			$('.country-error').hide();
		}
	});
});
$("#venue-contact").ready(function(){
	var $regexname = /^([0-9]{7,15})$/;
	$("#venue-contact").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.contact-error').show();
		}
		else{
			$('.contact-error').hide();
		}
	});
});

$("#venue-mobile").ready(function(){
	var $regexname = /^([0-9]{10})$/;
	$("#venue-mobile").on('keypress keydown keyup',function(){
		if(!$(this).val().match($regexname)){
			$('.mobile-error').show();
		}
		else{
			$('.mobile-error').hide();
		}
	});
});
$("#start-one").change(function(){
		
	$("#start-one").on('keypress keydown keyup',function(){
   		var starttime=$('#start-one').val();
   		alert('ok');
        document.getElementById('display').value = starttime;
	});
});

$("#first-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{4,25})$/;
  $("#first-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.firstname-error').show();
    }
    else{
      $('.firstname-error').hide();
    }
  });
});
$("#last-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{4,25})$/;
  $("#last-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.lastname-error').show();
    }
    else{
       
      $('.lastname-error').hide();
    }
  });
});
$("#middle-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{4,25})$/;
  $("#middle-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.middlename-error').show();
    }
    else{
      $('.middlename-error').hide();
    }
  });
});
$("#title").ready(function(){
var $regexname=/^([a-zA-Z0-9_ ]{4,25})$/;
  $("#title").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.title-error').show();
    }
    else{
      $('.title-error').hide();
    }
  });
});
$("#instructor-town").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#instructor-town").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error-town').show();
    }
    else{
      $('.error-town').hide();
    }
  });
});
$("#instructor-city").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#instructor-city").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error-city').show();
    }
    else{
      $('.error-city').hide();
    }
  });
});
$("#instructor-postcode").ready(function(){
var $regexname=/^([0-9_ ]{5,10})$/;
  $("#instructor-postcode").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error-instrucotcode').show();
    }
    else{
      $('.error-instrucotcode').hide();
    }
  });
});
$("#instructor-country").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#instructor-country").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('.error-instructorcountry').show();
    }
    else{
      $('.error-instructorcountry').hide();
    }
  });
});
$("#phone1").ready(function(){
var $regexname=/^([0-9_ ]{10,15})$/;
  $("#phone1").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#message1').show();
    }
    else{
      $('#message1').hide();
    }
  });
});
$("#phone2").ready(function(){
var $regexname=/^([0-9_ ]{10,15})$/;
  $("#phone2").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#message2').show();
    }
    else{
      $('#message2').hide();
    }
  });
});
function members(gname,gid){
  $("#groupname").html(gname);
  $("#group-name").val(gname);
  $("#group_id").val(gid);
}
function group(url){
  window.location.assign(url);
}
//heat
function heats(url){
  var selectedCountry = $(".country option:selected ").val();
  window.location.assign(url+'/'+selectedCountry);
}
function result(url){
  window.location.reload(url);
}
$("#stage-no").ready(function(){
var $regexname=/^([0-9]{3,10})$/;
  $("#stage-no").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#error-msg').show();
    }
    else{
      $('#error-msg').hide();
    }
  });
});
$("#stage-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#stage-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#msg').show();
    }
    else{
      $('#msg').hide();
    }
  });
});
$("#heat-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#heat-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#error').show();
    }
    else{
      $('#error').hide();
    }
  });
});
$("#heat-course").ready(function(){
var $regexname=/^([0-9]{2,10})$/;
  $("#heat-course").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#msg').show();
    }
    else{
      $('#msg').hide();
    }
  });
});

//heat
function heats(url){
  var selectedCountry = $(".country option:selected ").val();
  window.location.assign(url+'/'+selectedCountry);
}
function result(url){
  window.location.reload(url);
}
$("#stage-no").ready(function(){
var $regexname=/^([0-9]{3,10})$/;
  $("#stage-no").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#error-msg').show();
    }
    else{
      $('#error-msg').hide();
    }
  });
});
$("#stage-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#stage-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#msg').show();
    }
    else{
      $('#msg').hide();
    }
  });
});
$("#heat-name").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#heat-name").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#error').show();
    }
    else{
      $('#error').hide();
    }
  });
});
$("#heat-course").ready(function(){
var $regexname=/^([0-9]{2,10})$/;
  $("#heat-course").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $('#msg').show();
    }
    else{
      $('#msg').hide();
    }
  });
});

function shortName(url) {
          var email = $('#email').val();
          jQuery.ajax({
    url: url+'/'+email,
    success:function(value){
      if(value == "success"){
        var temp = new Array();
          temp = email.split("@");
          console.log(temp[0]);
          $('#display').val(temp[0]);
        $("#message").html("");
          $("#instructor-contact").removeAttr('disabled');
      }
      else{
        $("#instructor-contact").attr('disabled', 'disabled');
      $("#message").html("<span style='color:red'>Email are Exist.</span>");
    } 
  },
    async:true
  });
}

function eventshortname(url){
  var shortname = $("#short-name").val();
 jQuery.ajax({
    url: url+'/'+shortname,
    success:function(value){
      if(value == "success"){
        $("#message").html("");
          $("#saveevent").removeAttr('disabled');
      }
      else{
        $("#saveevent").attr('disabled', 'disabled');
      $("#message").html("<span style='color:red'>ShortName Already exists.Please Add numeric characters or change shortname</span>");
    } 
  },
    async:true
  });
}

function venueshortname(url){
   var shortname = $("#venue-short-name").val();
 jQuery.ajax({
    url: url+'/'+shortname,
    success:function(value){
      if(value == "success"){
        $("#message").html("");
          $("#savevenue").removeAttr('disabled');
      }
      else{
        $("#savevenue").attr('disabled', 'disabled');
      $("#message").html("<span style='color:red'>ShortName Already exists.Please Add numeric characters or change shortname</span>");
    } 
  },
    async:true
  });
}

function clubshortname(url){
    var shortname = $("#shortname").val();
  jQuery.ajax({
    url: url+'/'+shortname,
    success:function(value){
      if(value == "success"){
        $("#message").html("");
          $("#save-club").removeAttr('disabled');
      }
      else{
        $("#save-club").attr('disabled', 'disabled');
      $("#message").html("<span style='color:red'>ShortName Already exists.Please Add numeric characters or change shortname</span>");
    } 
  },
    async:true
  });
}

function registermail(url) {
         var email = $('#email').val();
         jQuery.ajax({
   url: url+'/'+email,
   success:function(value){
     if(value == "success"){
       console.log(email);
          var temp = new Array();
          temp = email.split("@");
          console.log(temp[0]);
          $('#display').val(temp[0]);
       $("#error-email").hide();
         $("#register").removeAttr('disabled');
     }
     else{
       $("#register").attr('disabled', 'disabled');
     $("#error-email").show();
   }
 },
   async:true
 });
}

$('#venuecode').ready(function(){
  var $regexname=/^([0-9]{5,10})$/;
   $('#venuecode').on('keypress keydown keyup',function(){
            if (!$(this).val().match($regexname)) {
                $('#message').html('Post Code Should contain Numeric Caracters');
            }
          else{
               $('#message').html('');
               
              }
        });
});
$('#landline').ready(function(){
 var $regexname=/^([0-9]{5,15})$/;
  $('#landline').on('keypress keydown keyup',function(){
           if (!$(this).val().match($regexname)) {
               $('.landline-error').html('landline Number should contain 5-15 Numeric Caracters');
           }
         else{
              $('.landline-error').html('');

             }
       });
});
$("#pool-width").ready(function(){
    var $regexname = /^((?<=^| )\d+(\.\d+)?(?=$| ))$/;
    $("#pool-width").on('keypress keydown keyup',function(){
        if(!$(this).val().match($regexname)){
            $('.pool-width-error').show();
     $(".add-pool").attr('disabled', 'disabled');
        }
        else{
            $('.pool-width-error').hide();
     $(".add-pool").removeAttr('disabled');
        }
    });
});
$("#pool-length").ready(function(){
    var $regexname = /^((?<=^| )\d+(\.\d+)?(?=$| ))$/;
    $("#pool-length").on('keypress keydown keyup',function(){
        if(!$(this).val().match($regexname)){
            $('.pool-length-error').show();
     $(".add-pool").attr('disabled', 'disabled');
        }
        else{
            $('.pool-length-error').hide();
      $(".add-pool").removeAttr('disabled');
        }
    });
});
$("#shallow-end").ready(function(){
    var $regexname = /^((?<=^| )\d+(\.\d+)?(?=$| ))$/;
    $("#shallow-end").on('keypress keydown keyup',function(){
        if(!$(this).val().match($regexname)){
     $(".add-pool").attr('disabled', 'disabled');
            $('.shallow-end-error').show();
        }
        else{
            $('.shallow-end-error').hide();
      $(".add-pool").removeAttr('disabled');
        }
    });
});
$("#deep-end").ready(function(){
    var $regexname = /^((?<=^| )\d+(\.\d+)?(?=$| ))$/;
    $("#deep-end").on('keypress keydown keyup',function(){
        if(!$(this).val().match($regexname)){
            $('.deep-end-error').show();
     $(".add-pool").attr('disabled', 'disabled');
        }
        else{
            $('.deep-end-error').hide();
      $(".add-pool").removeAttr('disabled');
        }
    });
});

