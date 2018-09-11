var masonryOptions = {
  itemSelector: '.grid-item'
  // columnWidth: 80
};
$(window).load(function() {
  var $grid = $('.grid').masonry( masonryOptions );
 })

$(function() {
 
if ($.fn.reflect) {
  $('#desk-slider-coverflow .cover').reflect(); // only possible in very specific situations
}

$('#desk-slider-coverflow').coverflow({
  index:      4,
  density:    2,
  innerOffset:  50,
  innerScale:   .7,
  outerAngle: 75,
  animateStep:  function(event, cover, offset, isVisible, isMiddle, sin, cos) {
    if (isVisible) {
      if (isMiddle) {
        $(cover).css({
          'filter':     'none',
          '-webkit-filter': 'none'
        });
      } else {
        var brightness  = 1 + Math.abs(sin),
          contrast  = 1 - Math.abs(sin),
          filter    = 'contrast('+contrast+') brightness('+brightness+')';
        $(cover).css({
          'filter':     filter,
          '-webkit-filter': filter
        });
      }
    }
  }

});
});


$(function() {
 
if ($.fn.reflect) {
  $('#res-slider-coverflow .cover').reflect();  // only possible in very specific situations
}

$('#res-slider-coverflow').coverflow({
  index:      4,
  density:    2,
  innerOffset:  50,
  innerScale:   .7,
  outerAngle: 5,
  animateStep:  function(event, cover, offset, isVisible, isMiddle, sin, cos) {
    if (isVisible) {
      if (isMiddle) {
        $(cover).css({
          'filter':     'none',
          '-webkit-filter': 'none'
        });
      } else {
        var brightness  = 1 + Math.abs(sin),
          contrast  = 1 - Math.abs(sin),
          filter    = 'contrast('+contrast+') brightness('+brightness+')';
        $(cover).css({
          'filter':     filter,
          '-webkit-filter': filter
        });
      }
    }
  }

});
      });


$(function(){
    $(".shw-pop").popover({
        html : true,
        trigger:'click',
        placement:'auto right',
        content: function() {
          return $(".rating-details").html();
        }
    }).on("mouseenter",function(){
      var _this = this;
      $(this).popover("show");
      $(".popover").on("mouseleave", function () {
        $(_this).popover('hide');
    });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide")
            }
        }, 100);
});
});


$(function(){
    $(".cmg-pop").popover({
        html : true,
        trigger:'manual',
        placement:'bottom',
        content: function() {
          return $(".rating-votes").html();
        }
    }).on("mouseenter",function(){
      var _this = this;
      $(this).popover("show");
      $(".popover").on("mouseleave", function () {
        $(_this).popover('hide');
    });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide")
            }
        }, 100);
});
});


$(function(){
    $(".mv-rate").popover({
        html : true,
        trigger:'manual',
        placement:'auto right',
        container: "body",
        content: function() {
          return $(".rating-details").html();
        }
    }).on("mouseenter",function(){
      var _this = this;
      $(this).popover("show");
      $(".popover").on("mouseleave", function () {
        $(_this).popover('hide');
    });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide")
            }
        }, 100);
});
});
$(document).ready(function(){
  $('.myModal').on('click',function(){
    $('#video-modal').modal();
  });
    $('.galleryModal').on('click',function(){
    $('#gallery-popup').modal();
    setTimeout(function(){
      $('.owl-carousel').owlCarousel({
            loop:true,
            items:1,
            nav: true, 
            navText: ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"]
        })
    },400)
  });
    $('.videoModal').on('click',function(){
    $('#video-popup').modal();
  });
    $('.book-nw-btn').on('click',function(){
    $('#video-modal').modal();
  });
    $('.newModal').on('click',function(){
    $('#loc-modal').modal();
  });
   $('.user-search').on('click',function(){
    $('#loc-modal-mob').modal();
  });
  // $('#loc-modal').modal({
    //  backdrop: 'static',
      //keyboard: false
  //});
  $('.states').tooltip({
      'container': 'body',
      'placement': 'left'
  })
});


 $(document).on('click','.w-f-m',function(){
    $('#fyi-meter').modal();
  })


$(window).load(function(){
    'use strict'
     $('.mv-names ul li').dotdotdot({ watch: 'window' });
})

$(document).ready(function(){
  $('.mv-shwtime').on('click',function(){
     $('.mv-name-toggle').hide();
       // $(this).find('.glyphicon-triangle-bottom').removeClass()
       $(this).parent().next().toggle();
      })
  })

$(document).ready(function(){
$('.mv-type-btn').click(function(){
  $('.mv-type-btn').removeClass('mv-type-color');
  $(this).addClass('mv-type-color');
});
})

Waves.init();
Waves.attach('.load-btn', ['waves-button', 'waves-float'])

$(document).ready(function(){
    $("#import").click(function(){
        $("#list").slideToggle("slow");
    });
});
