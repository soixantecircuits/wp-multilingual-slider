<?php 

add_script('flexslider-min', 'jquery.flexslider-min.js');
add_script('flex-main-js', 'main.js');

function add_script($script_name, $script_src, $require_script = array('jquery')) {
  wp_deregister_script($script_name);
  wp_register_script($script_name, 
    plugins_url( "/js/".$script_src, __FILE__ ),
    $require_script, 
    1.0,
    TRUE);
  wp_enqueue_script($script_name); 
}

?>
