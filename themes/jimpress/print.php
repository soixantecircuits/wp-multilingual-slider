<?php

function print_current_slides($slides) { ?>
	<section id="jms-slideshow" class="jms-slideshow">
	<?php
	for ($i = 0; $i < count($slides); $i++) { ?>
		<div class="step" data-color="color-2" data-x="<?php echo rand(0, 5000); ?>" data-y="<?php echo rand(0, 5000); ?>" data-rotate="<?php echo rand(0, 180); ?>">
			<div class="jms-content">
				<h3><?php echo $slides[$i]['title']; ?></h3>
				<p><?php echo $slides[$i]['legend']; ?></p>
				<a class="jms-link" href="<?php echo $slides[$i]['url']; ?>">Read more</a>
			</div>
			<img src="<?php echo $slides[$i]['img'] ?>" />
		</div><?php
	}
/*	
	<div class="step" data-color="color-2" data-y="500" data-scale="0.4" data-rotate-x="30">
			<div class="jms-content">
				<h3>Holy cannoli!</h3>
				<p>But as the riper should by time decease, his tender heir might bear his memory</p>
				<a class="jms-link" href="#">Read more</a>
			</div>
			<img src="images/2.png" />
		</div>
		<div class="step" data-color="color-3" data-x="2000" data-z="3000" data-rotate="170">
			<div class="jms-content">
				<h3>No time to waste</h3>
				<p>Within thine own bud buriest thy content and, tender churl, makest waste in niggarding</p>
				<a class="jms-link" href="#">Read more</a>
			</div>
			<img src="images/3.png" />
		</div>
		<div class="step" data-color="color-4" data-x="3000">
			<div class="jms-content">
				<h3>Supercool!</h3>
				<p>Making a famine where abundance lies, thyself thy foe, to thy sweet self too cruel</p>
				<a class="jms-link" href="#">Read more</a>
			</div>
			<img src="images/4.png" />
		</div>
		<div class="step" data-color="color-5" data-x="4500" data-z="1000" data-rotate-y="45">
			<div class="jms-content">
				<h3>Did you know that...</h3>
				<p>Thou that art now the world's fresh ornament and only herald to the gaudy spring</p>
				<a class="jms-link" href="#">Read more</a>
			</div>
			<img src="images/5.png" />
		</div>
*/
	?>
	</section>
	<?php 
} ?>
<script type="text/javascript">
jQuery(function() {
	jQuery( '#jms-slideshow' ).jmslideshow();
});
</script>
