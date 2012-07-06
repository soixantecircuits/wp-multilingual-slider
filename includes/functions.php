<?php

function add_script($script_src, $script_name, $require_script = array('jquery')) {
	wp_deregister_script($script_name);
	wp_register_script(
		$script_name, 
		"/wp-content/plugins/wp-multilingual-slider/themes/".get_option("home_themes")."/js/".$script_src, 
		$require_script, 
		1.0, 
		true
	);
	wp_enqueue_script($script_name); 
}

function add_style($style_src, $style_name) {
	wp_register_style(
		$style_name,
		"/wp-content/plugins/wp-multilingual-slider/themes/".get_option("home_themes")."/css/".$style_src, 
		false,
		0.1
	);
	wp_enqueue_style( $style_name );
}

function add_custom_style($style_src, $style_name) {
	wp_register_style(
		$style_name,
		$style_src, 
		false,
		0.1
	);
	wp_enqueue_style( $style_name );
}

?>
