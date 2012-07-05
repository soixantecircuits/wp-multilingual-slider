<?

function print_current_slides($slides) { ?>
	<div>
		<div class="flexslider">
		<ul class="slides">
		<?php
		for ($i = 0; $i < count($slides); $i++) { ?>
			<li>
				<img class="png" src="<?php echo $slides[$i]['img']; ?>" alt="image description" width="488" height="306" onclick="window.location = '<?php echo $slides[$i]['url']; ?>'" />
				<strong class="stronk"><?php echo $slides[$i]['title']; ?></strong>
				<div class=flex_caption>
					<h2><?php echo $slides[$i]['sub']; ?></h2>
					<?php echo $slides[$i]['legend']; ?>
				</div>
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
</script>
