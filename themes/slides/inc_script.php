<?php 

add_script('linking', 'js/slides.min.jquery.js');

function add_script($script_name, $script_src, $require_script = array('jquery')) {
	wp_deregister_script($script_name);
	wp_register_script($script_name, plugins_url( $script_src, __FILE__ ), $require_script, 1.0, TRUE);
	wp_enqueue_script($script_name); 
}

?>
