<?php
require_once('load_theme.php');
require_once('home_slider.php');
require_once("functions.php");

function wpms_front_init() {
	if (!is_admin()) {
		add_shortcode("display_slider", "wpms_shortcode");
	}
}

function wpms_shortcode() {
	if (function_exists('print_home_slider')) {
		print_home_slider();
	} else {
		return __("Coco slider seems not to be installed. Please activate it, or download it.", "wp-multilingual-slider");
	}
}
