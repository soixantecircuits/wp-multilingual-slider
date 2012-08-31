<?php

function wpms_init_themes_slider()
{
	$themes_name = get_option("home_themes");
	$isInThemes = false;
	if (strstr($themes_name, "_THEMES_") != false) {
		$isInThemes = true;
		$themes_name = str_replace('_THEMES_', '', $themes_name);
	}
	$custom_themes = $isInThemes ? "themes/".basename(get_template_directory())."/" : "";
	if ($themes_name == null) {
		return;
	}
	$themes_dir = "wp-content/".$custom_themes."plugins/wp-multilingual-slider/themes/" . $themes_name ."/";
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
		load_conf($myDataArr, $custom_themes);
	}
}

function load_conf($config, $custom_themes)
{
	if (isset($config['conf']['script']) && $config['conf']['script'] !== null) {
		foreach ($config['conf']['script'] as $key => $value) {
			add_script($value, $key, $custom_themes);
		}
	}

	if (isset($config['conf']['css']) && $config['conf']['css'] !== null) {
		foreach ($config['conf']['css'] as $key => $value) {
			add_style($value, $key, $custom_themes);
		}
	}
}
?>