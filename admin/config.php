<?php

function xb_classifieds_init() {
	// Add permission on role during the plugin activation
	register_activation_hook ( __FILE__, 'xb_classifieds_build_permissions' );
	
	add_action('admin_init', 'my_admin_init');
	add_action('admin_menu', 'home_create_menu');
	load_plugin_textdomain( 'wp-multilingual-slider', 'wp-content/plugins/wp-multilingual-slider/lang/');
	require (ABSPATH . "wp-content/plugins/wp-multilingual-slider/includes/functions.php");
}
 
function xb_classifieds_build_permissions() {
	// FIXME add permission to editor & author
	if (function_exists('get_role')) {
		$role = array(get_role('administrator'), get_role('editor'), get_role('author'));
		foreach ($role as $r) {
			if ($r != null && !$role->has_cap('use_accueil')) {
				$r->add_cap('use_accueil');
			}
			if ($r != null && !$role->has_cap('admin_accueil')) {
				$r->add_cap('admin_accueil');
			}
			unset($r);
		}
		
	}
}

?>
