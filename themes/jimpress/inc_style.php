<?php 

//jQuery('head').append('<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/style_ie.css" /><![endif]-->');
add_style("css/style.css");
add_custom_style("http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic");

function add_style($style_src) {
	?>
	<script type="text/javascript">
		jQuery('head').append('<link rel="stylesheet" href="<?php echo plugins_url( $style_src, __FILE__ ); ?>" type="text/css" />');
	</script>
	<?php
}

function add_custom_style($style_src) {
	?>
	<script type="text/javascript">
		jQuery('head').append('<link rel="stylesheet" href="<?php echo $style_src; ?>" type="text/css" />');
	</script>
	<?php
}
