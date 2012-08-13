<?

function print_current_slides($slides) {
	$themes_dir = plugin_dir_url(__FILE__); ?>
	<div id="example">
		<div id="slides">
			<div class="slides_container">
				<?php
				for ($i = 0; $i < count($slides); $i++) { ?>
					<div class="slide">
						<img src="<?php echo $slides[$i]['img']; ?>" />
						<div class="caption" style="bottom:0">
							<h1><?php echo $slides[$i]['title']; ?></h1>
							<p><?php echo $slides[$i]['sub']; ?></p>
							<p><?php echo $slides[$i]['legend']; ?></p>
							<p style="position:absolute; bottom: 70px; right: 20px;"><a href="<?php echo $slides[$i]['url']; ?>" class="link">Read more</a></p>
						</div>
					</div>
				<?php
				} ?>
			</div>
			<a href="#" class="prev"><img src="<?php echo $themes_dir; ?>/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
			<a href="#" class="next"><img src="<?php echo $themes_dir; ?>/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
		</div>
		<img src="<?php echo $themes_dir; ?>/img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
	</div>
<?php
}

?>
