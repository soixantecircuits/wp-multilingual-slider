<?

function print_current_slides($slides) { ?>
<div id="any_id" class="barousel">
    <div class="barousel_image">
        <!-- image 1 -->
        <img src="http://localhost/bel/wp-content/themes/bel/screenshot.png" alt="" class="default" />
        <!-- image 2 -->
        <img src="http://localhost/bel/wp-content/themes/bel/screenshot.png" alt="" />
        <!-- image xx -->
        <img src="http://localhost/bel/wp-content/themes/bel/screenshot.png" alt="" />
    </div>
    <div class="barousel_content">
        <!-- content 1 -->
        <div class="default">
            [any html content]
        </div>
        <!-- content 2 -->
        <div>
            [any html content]
        </div>
        <!-- content xx -->
        <div>
            [any html content]
        </div>
    </div>
    <div class="barousel_nav">
    </div>
</div>
<?php
} 

?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#barousel_itemnav').barousel({
    	manualCarousel: 1
	});
});
</script>
