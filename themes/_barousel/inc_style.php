<?php 

// No style to add

function add_style($style_src) {
	?>
	<script type="text/javascript">
		jQuery('head').append('<link rel="stylesheet" href="<?php echo plugins_url( $style_src, __FILE__ ); ?>" type="text/css" />');
	</script>
	<?php
}
