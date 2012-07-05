<?php 

add_script("jimpress.min", "js/jmpress.min.js");
add_script("jmslideshow", "js/jquery.jmslideshow.js");
add_script("modernizr", "js/modernizr.custom.48780.js");

function add_script($script_name, $script_src, $require_script = array('jquery')) {
	wp_deregister_script($script_name);
	wp_register_script($script_name, plugins_url( $script_src, __FILE__ ), $require_script, 1.0, TRUE);
	wp_enqueue_script($script_name); 
}

?>
