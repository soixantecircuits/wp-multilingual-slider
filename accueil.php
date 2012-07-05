<?php
/*
Plugin Name: Image accueil
Plugin URI: http://www.soixantecircuits.fr/
Description: Permet de gérer les images en fonction des langues afin de les utiliser dans un slider par example
Author: Soixante Circuits
Version: 1.1
Author URI: http://www.soixantecircuits.fr/
*/

require( dirname(__FILE__) . '/admin/admin-menu.php' );
// Activation de l'extension
add_action( 'plugins_loaded', 'xb_classifieds_init' );

function xb_classifieds_init() {
	// Add permission on role during the plugin activation
	register_activation_hook ( __FILE__, 'xb_classifieds_build_permissions' );
	
	add_action('admin_init', 'my_admin_init');
	add_action('admin_menu', 'home_create_menu');
}
 
function xb_classifieds_build_permissions() {
	if ( function_exists( 'get_role' ) ) {
		$role = get_role( 'administrator' );
		if ( $role != null && !$role->has_cap( 'use_accueil' ) ) {
			$role->add_cap( 'use_accueil' );
		}
		if ( $role != null && !$role->has_cap( 'admin_accueil' ) ) {
			$role->add_cap( 'admin_accueil' );
		}
		
		unset($role);
		
		/*$role = get_role( 'editor' );
		if ($role != null && !$role->has_cap( 'use_accueil' ) ) {
			$role->add_cap( 'use_accueil ' );
		}
		
		unset($role);*/
	}
}

function init_themes_slider() {
	$themes_name = get_option("home_themes");
	$themes_dir = "/wp-content/plugins/wp-multilingual-slider/themes/" . $themes_name . "/";
	require (ABSPATH . $themes_dir . "inc_style.php");
	require (ABSPATH . $themes_dir . "inc_script.php");
	require (ABSPATH . $themes_dir . "print.php");
}

function get_current_slides() {
	$_slides = get_option("home_content");
	$lang = 'fr';
	if (function_exists('qtrans_getLanguage')) {
	  	$lang = qtrans_getLanguage();
	} else if (function_exists('icl_get_languages')) {
		$lang = icl_get_languages();
	}
	$_slides = json_decode($_slides[$lang]);
	$slides = null;
	for ($i = 0; $i < count($_slides)/5; $i++) {
		$slides[] = array(
			'title'  => $_slides[$i*5]->{'value'},
			'sub'    => $_slides[$i*5+1]->{'value'},
			'legend' => $_slides[$i*5+2]->{'value'},
			'url'    => $_slides[$i*5+3]->{'value'},
			'img'    => $_slides[$i*5+4]->{'value'}
		);
	}
	return $slides;
}

function print_home_slider() {
	init_themes_slider();
	$slides = get_current_slides();
	if (count($slides) > 0) { ?>
			<?php if (function_exists("print_current_slides")) {
				print_current_slides($slides); 
			} ?>
	<?php
		wp_reset_query();
	}
}
?>
