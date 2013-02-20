<?php
require_once("config.php");
require_once("admin_menu.php");

function wpms_admin_init() {
	wpms_classifieds_init();
	do_action("wpms_init");
}

function wpms_register() {
	wp_deregister_script('json2');
	wp_register_script('json2', WPMS_DIR.'/inc/admin/resources/javascript/json2.js');
	wp_deregister_script('showdown');
	wp_register_script('showdown', WPMS_DIR.'/inc/admin/resources/javascript/showdown.js');
	wp_enqueue_script('showdown');
	wp_enqueue_script( 'accueil_script', WPMS_DIR.'/inc/admin/resources/javascript/ui_controller.js', array('jquery'), 0.1, TRUE );
	wp_register_style('myStyleSheets', WPMS_DIR.'/inc/admin/resources/css/style_home.css');
	wp_enqueue_style( 'myStyleSheets');

	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-ui-tabs' );

	if(function_exists("add_thickbox")){
		add_thickbox();
	}else{
		wp_enqueue_script('thickbox');
	}
	wp_enqueue_script('media-upload');
}

function wpms_version(){
	$installed_ver = get_option( "wp_multilingual_slider_version" );
	echo "<!-- wpms version : $installed_ver -->";
}