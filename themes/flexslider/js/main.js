jQuery(function(){
  "use strict";
  if(jQuery(".flexslider").flexslider !== undefined){
  jQuery(".flexslider").flexslider({
    animation: "slide",
    initDelay: 0,
    animationLoop: true,
    useCSS: true,
    touch: true,
    video: true,
    controlsContainer: "#flex-controller",
    directionNav: false,
    start: function() {
      jQuery(".flex-viewport").height(jQuery(".flex-active-slide").height());
    },
    before: function() {
      jQuery(".flex-viewport").height(jQuery(".flex-active-slide").next().height());
    }
  });
  jQuery("#flex-controller").append('<ul class="pause"><li><a href="#" class="pause" id="pause-button">pause</a></li></ul>');
  jQuery(window).bind("resize", function() {
    jQuery(".flex-viewport").height(jQuery(".flex-active-slide").height());
  });
  jQuery("#pause-button").click(function() {
    var _slider = jQuery('.flexslider').data('flexslider');
    if (_slider.playing) {
      _slider.flexslider('pause');
      jQuery(this).addClass("active");
    } else {
      _slider.flexslider('next');
      _slider.flexslider('play');
      jQuery(this).removeClass("active");
    }
    return false;
  });
  }
});