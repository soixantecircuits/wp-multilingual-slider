<?php
require_once("lang_codes.php");
require_once("display.php");
require_once("js_translation.php");

function wpms_show_message()
{
	$themes_name = get_option("home_themes");
	if ($themes_name == null)
	{
		echo '<div id="message" class="error">';
		echo "<p><strong>".__("Choose a theme for Coco slider.", "wp-multilingual-slider")."</strong></p></div>";
	}
}
add_action('admin_notices', 'wpms_show_message');

function wpms_get_all_themes() {
	$themes_dir = ABSPATH . "/wp-content/plugins/wp-multilingual-slider/themes/";
	$custom_dir = get_template_directory() . "/plugins/wp-multilingual-slider/themes/";
	 //Open a known directory, and proceed to read its js content
	echo "<option value=".
		__("none", "wp-multilingual-slider").">".
		__("none", "wp-multilingual-slider")."</option>";
	if ($handle = opendir($themes_dir)) {
		$selected = get_option("home_themes");
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo "<option ".
					($entry == $selected ? "selected='selected'" : "").
					(file_exists($themes_dir . $entry . "/screenshot.png") ? "screenshot='true'" : "").
					"value=$entry>$entry</option>";
			}
		}
	}
	if ($handle = opendir($custom_dir)) {
		$selected = get_option("home_themes");
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo "<option ".
					("_THEMES_".$entry == $selected ? "selected='selected'" : "").
					(file_exists($custom_dir . $entry . "/screenshot.png") ? "screenshot='true'" : "").
					"value=_THEMES_$entry>[Themes] $entry</option>";
			}
		}
	}
}

function home_settings_page()
{
	if(function_exists("icl_get_languages")) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		$sel_lang = Array();
		foreach($languages as $l => $k){
			array_push($sel_lang, $l);
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