<?php 
add_style("flexslider.css", "flexslider");
function add_style($style_src, $style_name) {
	wp_register_style(
        $style_name,
        plugins_url( "/css/".$style_src, __FILE__ ),
        false,
        0.1
    );
  wp_enqueue_style( $style_name );
}
