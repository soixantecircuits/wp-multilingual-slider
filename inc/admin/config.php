<?php
function wpms_classifieds_init() {
	// Add permission on role during the plugin activation
	register_activation_hook ( __FILE__, 'wpms_classifieds_build_permissions' );
	
	add_action('admin_init', 'wpms_register');
	add_action('admin_menu', 'wpms_home_create_menu');
	load_plugin_textdomain( 'wp-multilingual-slider', 'wp-content/plugins/wp-multilingual-slider/languages/');
}
 
function wpms_classifieds_build_permissions() {
	// FIXME add permission to editor & author
	do_action("wpms_build_premissions");
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

function wpms_home_create_menu() {
	//Create new top-level menu
	do_action("wpms_create_top_menu");
	add_menu_page( __('Paramètre accueil'), 'Coco Slider', 'edit_pages', 'settings_page_wp-multilingual-slider', 'home_settings_page', WPMS_DIR.'/inc/admin/resources/images/accueil.png');
}
?>
