<?php

function print_current_slides($slides) { ?>
	<ul id="images" class="rs-slider">
		<?php
		for ($i = 0; $i < count($slides); $i++) { ?>
			<li class="group">
				<div class="photo-wrap">
					<a href="<?php echo $slides[$i]['url']; ?>">
						<img src="<?php echo $slides[$i]['img']; ?>" alt="" width="550px" />
					</a>
				</div>
				<div class="rs-caption rs-bottom">
					<h3><?php echo $slides[$i]['title']; ?></h3>
					<p><?php echo $slides[$i]['legend']; ?></p>
				</div>
			</li>
		<?php
		} ?>
	</ul>
<?php 
}

?>
