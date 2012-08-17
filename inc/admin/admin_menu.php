<?php

require_once("lang_codes.php");
require_once("display.php");
require_once("js_translation.php");

function wpms_get_all_themes() {
	$themes_dir = ABSPATH . "/wp-content/plugins/wp-multilingual-slider/themes/";
	// Open a known directory, and proceed to read its js content
	if ($handle = opendir($themes_dir)) {
		$selected = get_option("home_themes");
		echo "<option value=".
			__("none", "wp-multilingual-slider").">".
			__("none", "wp-multilingual-slider")."</option>";
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo "<option ".
					($entry == $selected ? "selected='selected'" : "").
					(file_exists($themes_dir . $entry . "/screenshot.png") ? "screenshot='true'" : "").
					"value=$entry>$entry</option>";
			}
		}
	}
}

function home_settings_page()
{
	if(function_exists("icl_get_languages")) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		foreach($languages as $l){
			$sel_lang[$i] = $l['language_code'];
			$i++;
		}
	} else if(function_exists("qtrans_init")) {
		$sel_lang = qtrans_getSortedLanguages();
	} else {
		$sel_lang = Array(0 => get_bloginfo('language'));
	}
	do_action('wpms_before_admin_display', $sel_lang);
	wpms_display($sel_lang);
	do_action('wpms_after_admin_display');
	wpms_js_translation();

} ?>
