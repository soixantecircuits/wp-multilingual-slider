<?php
function print_current_slides($slides) { ?>
	<div>
		<div class="flexslider">
		<ul class="slides">
		<?php
		foreach ($slides as $s) { ?>
			<li><?php
			if ($s['ext'] == "") { ?>
				<img class="png" src="<?php echo $s['img']; ?>" alt="image description" width="488" height="306" onclick="window.location = '<?php echo $s['url']; ?>'" />
				<div class=flex-caption>
					<div class="holder">
						<strong class="stronk"><?php echo $s['title']; ?></strong>
						<h2><?php echo $s['sub']; ?></h2>
						<?php echo $s['legend']; ?>
					</div>
				</div><?php
			} else {
				echo $s['ext'];
			} ?>
			</li><?php
		} ?>
		</ul>
		</div>
	</div><?php
}
?>
