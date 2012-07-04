<?

function print_current_slides($slides) { ?>
	<div>
		<div class="flexslider">
		<ul class="slides">
		<?php
		for ($i = 0; $i < count($slides); $i++) { ?>
			<li>
				<div>
					<img class="png" src="<?php echo $slides[$i]['img']; ?>" alt="image description" width="488" height="306" />
					<strong><?php echo $slides[$i]['title']; ?></strong>
				</div>
<!--
				<div class="info-panel">
					<strong class="location"><?php echo $slides[$i]['title']; ?></strong>
					<div class="holder">
						<h2><?php echo $slides[$i]['sub']; ?></h2>
						<p><?php echo $slides[$i]['legend']; ?></p>
					</div>
					<a href="<?php echo $slides[$i]['url']; ?>" class="link">en savoir</a>
				</div>
-->
			</li> <?php
		} ?>
		</ul>
		</div>
	</div><?php
} 

?>
<script type="text/javascript" charset="utf-8">
jQuery(window).load(function() {
	jQuery('.flexslider').flexslider();
  });
	jQuery('head').append('<link rel="stylesheet" href="wp-content/plugins/wp-multilingual-slider/themes/flexslider/flexslider.css" type="text/css" />');
</script>
