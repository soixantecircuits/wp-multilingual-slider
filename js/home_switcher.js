acceuil_plugin_flexslider = 
{
	directionNav: false,
	slideshowSpeed: 1000,
	animationDuration: 700
};
	
jQuery('.switch').each ( function () {
	jQuery(this).click ( function () {
		jQuery(".gallery ul li.active").removeClass("active");
		jQuery(".switcher li.active").removeClass("active");
		jQuery("#slide-"+jQuery(this).attr("switch")).addClass("active");
		jQuery("ul #switch-"+jQuery(this).attr("switch")).addClass("active");
	});
});

setInterval(function () { next_active_slide() }, 4000);

function next_active_slide () {
	var current = jQuery(".switcher li.active a").attr("switch");
	var max = jQuery(".switch").length;
	var curr = jQuery(".switcher li.active");
	var next = curr.next();
	if (next.length == 0) {
		next = jQuery(".switcher li#switch-0");
	}
	curr.removeClass("active");
	next.addClass("active");
	jQuery(".gallery ul li.active").removeClass("active");
	jQuery("#slide-"+jQuery(".switcher li.active a").attr("switch")).addClass("active");
	
}
