<?php
function print_current_slides($slides) { ?>
	<section id="jms-slideshow" class="jms-slideshow">
	<?php
	for ($i = 0; $i < count($slides); $i++) { ?>
		<div class="step" data-color="color-2" data-x="<?php echo rand(0, 5000); ?>" data-y="<?php echo rand(0, 5000); ?>" data-rotate="<?php echo rand(0, 180); ?>">
			<div class="jms-content">
				<h3><?php echo $slides[$i]['title']; ?></h3>
				<h4><?php echo $slides[$i]['sub']; ?></h4>
				<p><?php echo $slides[$i]['legend']; ?></p>
				<a class="jms-link" href="<?php echo $slides[$i]['url']; ?>">Read more</a>
			</div>
			<img src="<?php echo $slides[$i]['img'] ?>" />
		</div><?php
	}
	?>
	</section>
	<?php
}
?>
