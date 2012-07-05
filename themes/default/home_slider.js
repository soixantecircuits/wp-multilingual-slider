accueil_plugin_flexslider = 
{
	// Time between auto slide in milliseconds. Default : 5000
	slideSpeed: 5000,
	// Time for the animation in milliseconds. Default : 500 (Recommended [100-1000])
	animationDuration: 500
};

jQuery("#content").find('ul>li:first').addClass("active");
jQuery(".switcher").find("li:first").addClass("active");

var neverAuto = false;
var autoSlide = setInterval(function () { next_active_slide() }, accueil_plugin_flexslider.slideSpeed);
var fading = false;
var nextFade = -1;

jQuery('.switch').each ( function () {
	jQuery(this).click ( function () {
		fade_slide(jQuery("ul #switch-"+jQuery(this).attr("switch")), 
			jQuery("#slide-"+jQuery(this).attr("switch")));
		neverAuto = true;
	});
});

function fade_slide (next, nextSlide) {
	var curr = jQuery(".switcher li.active");
	var currSlide = jQuery(".gallery ul li.active");
	if (!fading) {
		if (curr.attr('id') != next.attr('id')) {
			fading = true;
			clearInterval(autoSlide);
			currSlide.fadeOut(accueil_plugin_flexslider.animationDuration, function () {
				next.addClass("active");
				nextSlide.addClass("active");
				curr.removeClass("active");
				currSlide.removeClass("active");
				nextSlide.hide().fadeIn(accueil_plugin_flexslider.animationDuration, function () {
						if (!neverAuto) {
							autoSlide = setInterval(function () { next_active_slide() }, accueil_plugin_flexslider.slideSpeed);
						}
						fading = false;
						if (nextFade != -1) {
							fade_slide(jQuery("ul #switch-"+nextFade), 
								jQuery("#slide-"+nextFade))
							nextFade = -1;
						}
				});
			});
		}
	} else {
		nextFade = next.children().attr('switch');
	}
}

function next_active_slide () {
	var next = jQuery(".switcher li.active").next();
	if (next.length == 0) {
		next = jQuery(".switcher li#switch-0");
	}
	var nextSlide = jQuery("#slide-"+next.children().attr("switch"));

	fade_slide(next, nextSlide);
}
