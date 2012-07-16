<?php
/*
Plugin Name: Image accueil
Plugin URI: http://www.soixantecircuits.fr/
Description: Permet de gérer les images en fonction des langues afin de les utiliser dans un slider par example
Author: Soixante Circuits
Version: 1.1
Author URI: http://www.soixantecircuits.fr/
*/

// XXX For debug
//=============================
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
//=============================

require( dirname(__FILE__) . '/admin/admin-menu.php' );
require( dirname(__FILE__) . '/admin/config.php');

// Activation de l'extension
add_action( 'plugins_loaded', 'xb_classifieds_init' );

function prepareJSON($input)
{
    
    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    $imput = mb_convert_encoding($input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');
    
    //Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);
    
    return $input;
}

function load_conf($config)
{
	if (isset($config['conf']['script']) && $config['conf']['script'] !== null) {
		foreach ($config['conf']['script'] as $key => $value) {
			add_script($value, $key);
		}
	}

	if (isset($config['conf']['css']) && $config['conf']['css'] !== null) {
		foreach ($config['conf']['css'] as $key => $value) {
			add_style($value, $key);
		}
	}
}

function init_themes_slider()
{
	$themes_name = get_option("home_themes");
	$themes_dir = "wp-content/plugins/wp-multilingual-slider/themes/" . $themes_name ."/";
	require (ABSPATH . $themes_dir . "show.php");
	$myFile = file_get_contents($themes_dir . 'theme.conf');
	if ($myFile == null) {
		load_conf(
			array("conf" => 
				array("script" => 
					array(
						$themes_name => $themes_name . ".js",
						"main" => "main.js",
					),
					array(
						$themes_name => $themes_name . ".css",
					),
				),
			)
		);
	} else {
		$myDataArr = json_decode(prepareJSON($myFile), true);
		load_conf($myDataArr);
	}
}

function get_current_slides()
{
	$_slides = get_option("home_content");
	$lang = 'fr';
	if (function_exists('qtrans_getLanguage')) {
	  	$lang = qtrans_getLanguage();
	} else if (function_exists('icl_get_languages')) {
		$lang = icl_get_languages();
	}
	$_slides = json_decode($_slides[$lang]);
	$slides = null;
	for ($i = 0; $i < count($_slides)/6; $i++) {
		$slides[] = array(
			'title'  => $_slides[$i*6  ]->{'value'},
			'sub'    => $_slides[$i*6+1]->{'value'},
			'legend' => $_slides[$i*6+2]->{'value'},
			'url'    => $_slides[$i*6+3]->{'value'},
			'img'    => $_slides[$i*6+4]->{'value'},
			'ext'		=> $_slides[$i*6+5]->{'value'}
		);
	}
	return $slides;
}

function print_home_slider()
{
	init_themes_slider();
	$slides = get_current_slides();
	if (count($slides) > 0) {
		if (function_exists("print_current_slides")) {
			print_current_slides($slides); 
		}
		wp_reset_query();
	}
}
?>
