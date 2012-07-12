<?php
function print_current_slides($slides) { ?>
	<div class="block-gallery">
		<div class="gallery">
		<ul>
		<?php
		for ($i = 0; $i < count($slides); $i++) { ?>
			<li id="slide-<?php echo $i;?>" class="">
				<div class="area">
					<img class="png" src="<?php echo $slides[$i]['img']; ?>" alt="image description" width="488" height="306" />
					<div class='elipsis'><strong><?php echo $slides[$i]['title']; ?></strong></div>
				</div>
				<div class="info-panel">
					<strong class="location"><?php echo $slides[$i]['title']; ?></strong>
					<div class="holder">
						<h2><?php echo $slides[$i]['sub']; ?></h2>
						<div class='elipsis'><p><?php echo $slides[$i]['legend']; ?></p></div>
					</div>
					<a href="<?php echo $slides[$i]['url']; ?>" class="link">en savoir</a>
				</div>
			</li><?php 
		} ?>
		</ul>
		</div>

		<ul class="switcher"><?php
		for ($i = 0; $i < count($slides); $i++) { ?>
			<li id="switch-<?php echo $i; ?>" class="">
				<a class="switch" switch="<?php echo $i; ?>" href="#"><?php echo $i+1; ?></a>
			</li><?php
		} ?>
		</ul>
	</div><?php
} 

?>
