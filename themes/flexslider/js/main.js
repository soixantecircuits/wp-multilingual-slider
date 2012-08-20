jQuery(function(){
  jQuery(window).load(function() {
    if(jQuery('.flexslider').length > 0 ){
      jQuery('.flexslider').flexslider({
			directionNav: false	
			,slideshowSpeed: 4000
			,animationDuration: 700
		});
    }
  });
});
