<?

function print_current_slides($slides) { ?>
	<div id="example">
		<div id="slides">
			<div class="slides_container">
				<?php
				for ($i = 0; $i < count($slides); $i++) { ?>
					<div class="slide">
						<img src="<?php echo $slides[$i]['img']; ?>" />
						<h1><?php echo $slides[$i]['title']; ?></h1>
						<p><?php echo $slides[$i]['sub']; ?></p>
						<p><a href="<?php echo $slides[$i]['url']; ?>" class="link">Read more</a></p>
					</div>
				<?php
				} ?>
			</div>
			<a href="#" class="prev"><img src="wp-content/plugins/wp-multilingual-slider/themes/linking/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
			<a href="#" class="next"><img src="wp-content/plugins/wp-multilingual-slider/themes/linking/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
		</div>
		<img src="wp-content/plugins/wp-multilingual-slider/themes/linking/img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
	</div>
<?php
}

?>
<script>
	jQuery(function(){
		// Set starting slide to 1
		var startSlide = 1;
		// Get slide number if it exists
		if (window.location.hash) {
			startSlide = window.location.hash.replace('#','');
		}
		// Initialize Slides
		jQuery('#slides').slides({
			preload: true,
			preloadImage: 'wp-content/plugins/wp-multilingual-slider/themes/linking/img/loading.gif',
			generatePagination: true,
			play: 5000,
			pause: 2500,
			hoverPause: true,
			// Get the starting slide
			start: startSlide,
			animationComplete: function(current){
				// Set the slide number as a hash
				window.location.hash = '#' + current;
			}
		});
	});
</script>
