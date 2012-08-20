<?php
require_once("config.php");
require_once("admin_menu.php");

function wpms_admin_init() {
	wpms_classifieds_init();
	do_action("wpms_init");
}

function wpms_register() {
	wp_deregister_script('showdown');
	wp_register_script('showdown', WPMS_DIR.'/inc/admin/resources/javascript/showdown.js');
	wp_enqueue_script('showdown');
	wp_enqueue_script( 'accueil_script', WPMS_DIR.'/inc/admin/resources/javascript/ui_controller.js', array('jquery'), 0.1, TRUE );
	wp_register_style('myStyleSheets', WPMS_DIR.'/inc/admin/resources/css/style_home.css');
  	wp_enqueue_style( 'myStyleSheets');
	wp_register_script( 'jquery_ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js' );
	wp_enqueue_script( 'jquery_ui' );

	if(function_exists("add_thickbox")){
		add_thickbox();
  	}else{
		wp_enqueue_script('thickbox');
  	}
  	wp_enqueue_script('media-upload');
	wpms_register_mysettings();
}

function wpms_register_mysettings() {  
	//register our settings  
	register_setting( 'home-settings-group', 'home_content');  
	register_setting( 'home-settings-select', 'home_themes');  
	register_setting( 'home-settings-config', 'theme_options');  
}

?>

