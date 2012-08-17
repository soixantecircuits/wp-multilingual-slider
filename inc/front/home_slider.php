<?php

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

function get_current_slides()
{
	$_slides = get_option("home_content");
	$lang = 'en-US';
	if (function_exists('qtrans_getLanguage')) {
	  	$lang = qtrans_getLanguage();
	} else if (function_exists('icl_get_languages')) {
		$lang = ICL_LANGUAGE_CODE;
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

function wpms_add_admin_bar($wp_admin_bar) {
	if (is_admin_bar_showing()) {
		$wp_admin_bar->add_menu(
			array(
				'id' => 'wp-multilingual-slider',
				'title' => 'Coco Slider',
				'href' => admin_url('admin.php?page=settings_page_wp-multilingual-slider')
			)
		);
	}
}

function print_home_slider()
{
	add_action( 'admin_bar_menu', 'wpms_add_admin_bar', 70 );
	$slides = get_current_slides();
	if (count($slides) > 0 && function_exists("print_current_slides")) {
		do_action('wpms_before_slider', $slides);
		print_current_slides($slides);
		do_action('wpms_after_slider', $slides);
	}
}
