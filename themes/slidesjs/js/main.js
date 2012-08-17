jQuery(function(){
	jQuery('#slides').slides({
		preload: true,
		preloadImage: 'wp-content/plugins/wp-multilingual-slider/themes/slides/img/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		animationStart: function(current){
			jQuery('.caption').animate({
				bottom:-100
			},100);
		},
		animationComplete: function(current){
			jQuery('.caption').animate({
				bottom:0
			},200);
		},
		slidesLoaded: function() {
			jQuery('.caption').animate({
				bottom:0
			},200);
		}
	});
});
