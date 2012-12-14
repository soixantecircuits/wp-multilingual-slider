<?php
/**
 * Dirty debug
 * 
 * */
/*function add_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js', '1.8');
	wp_enqueue_script('jquery');
}
add_action('wp_print_scripts', 'add_scripts');*/

function add_select ($name, $opt)
{
	echo "<tr><td><label for='$name' >$name : </label></td>";
	echo "<td><select name='$name'>";
	foreach ($opt as $o) {
		echo "<option value='$o'>$o</option>";
	}
	echo "</select></td></tr>";
}

function add_field ($name, $opt = 0)
{
	echo "<tr><td><label for='$name' >$name : </label></td>";
	echo "<td><input name='$name' value='$opt' /></td></tr>";
}

function add_script($script_src, $script_name, $custom_themes, $require_script = array('jquery'))
{
	$home_themes = str_replace('_THEMES_', '', get_option('home_themes'));
	wp_deregister_script($script_name);
	wp_register_script(
		$script_name,
		"/wp-content/".$custom_themes."plugins/wp-multilingual-slider/themes/".$home_themes."/js/".$script_src,
		$require_script,
		1.0,
		true
	);
	wp_enqueue_script($script_name);
}

function add_style($style_src, $style_name, $custom_themes)
{
	$home_themes = str_replace('_THEMES_', '', get_option('home_themes'));
	wp_register_style(
		$style_name,
		"/wp-content/".$custom_themes."plugins/wp-multilingual-slider/themes/".$home_themes."/css/".$style_src,
		false,
		0.1
	);
	wp_enqueue_style( $style_name );
}

function init_print_options ()
{
	echo '<form id="theme_options" method="post" action="options.php"><table>';
	settings_fields("home-settings-config");
	print_options();
	echo '</table>';
	echo '<button type="button" class="button-primary">' .
		__("Save", "wp-multilingual-slider") . '</button>';
	echo '</form>';
}
?>