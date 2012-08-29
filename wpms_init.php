<?php
/*
Plugin Name: WP-Multilingual-Slider
Plugin URI: http://www.soixantecircuits.fr/
Description: Allow to easily manage a slider on a multilingual wordpress site
Author: Soixante Circuits
Version: 1.1
Author URI: http://www.soixantecircuits.fr/
*/
ini_set('display_errors',1);
error_reporting(E_ALL);
define('WPMS_FILE_NAME', basename(dirname(__FILE__)));
define('WPMS_DIR', WP_PLUGIN_URL.'/'.WPMS_FILE_NAME);

require( dirname(__FILE__) . '/inc/admin/admin_init.php');
require( dirname(__FILE__) . '/inc/front/front_init.php');

// Plugin activation
add_action( 'plugins_loaded', 'wpms_admin_init' );
add_action( 'init', 'wpms_front_init');
<<<<<<< HEAD
?>
=======
?>
>>>>>>> updated_no_break
