<?php
function wpms_init_themes_slider()
{
	$themes_name = get_option("home_themes");
	if ($themes_name == null) {
		_e("Choose a theme for Coco slider.", "wp-multilingual-slider");
		return;
	}
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
?>
