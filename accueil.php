<?php
/*
Plugin Name: Image accueil
Plugin URI: http://www.soixantecircuits.fr/
Description: Permet de gérer les images en fonction des langues afin de les utiliser dans un slider par example
Author: Soixante Circuits
Version: 1.1
Author URI: http://www.soixantecircuits.fr/
*/

require( dirname(__FILE__) . '/admin-menu.php' );
// Activation de l'extension
add_action( 'plugins_loaded', 'xb_classifieds_init' );

function xb_classifieds_init() {
	// Add permission on role during the plugin activation
	register_activation_hook ( __FILE__, 'xb_classifieds_build_permissions' );
	wp_enqueue_script( 'home_switcher', plugin_dir_url().'/wp-multilingual-slider/js/home_switcher.js', array('jquery'), 0.1, TRUE );
	
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

function get_current_slides() {
	$_slides = get_option("home_content");
	$lang = 'fr';
	if (function_exists('qtrans_getLanguage')) {
	  	$lang = qtrans_getLanguage();
	} else if (function_exists('icl_get_languages')) {
		$lang = icl_get_languages();
	}
	$_slides = json_decode($_slides[$lang]);
	$nbElems = count($_slides);
	$slides = null;
	for ($i = 0; $i < $nbElems/5; $i++) {
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

function get_count_slider($slider) {
	return (count($slider))/5;
}

function is_empty_slider($slider) {
	return (get_count_slider($slider) == 0);
}

function print_home_slider($nbrposts) {
	$slider = get_current_slides();
	if (!is_empty_slider($slider)) {
?>
<div id="content">
<div class="block-gallery">
	<div class="gallery">
	<ul>
	<?php
	for ($i = 0; $i < get_count_slider($slider); $i++) {
	?>
		<li id="slide-<?php echo $i;?>"<?php if ($i == 0) { echo ' class="active"'; } ?>>
			<div class="area">
				<img class="png" src="<?php echo $slider[$i]['img']; ?>" alt="image description" width="488" height="306" />
				<strong><?php echo $slider[$i]['title']; ?></strong>
			</div>
			<div class="info-panel">
				<strong class="location"><?php echo $slider[$i]['title']; ?></strong>
				<div class="holder">
					<h2><?php echo $slider[$i]['sub']; ?></h2>
					<p><?php echo $slider[$i]['legend']; ?></p>
				</div>
				<a href="<?php echo $slider[$i]['url']; ?>" class="link">en savoir</a>
			</div>
		</li><?php 
		} 
		?>
	</ul>
	</div>
	
	<?php 
	if (get_count_slider($slider) > 0) { ?>
		<ul class="switcher"><?php
		for ($i = 0; $i < $nbElems/5; $i++) { ?>
			<li id="switch-<?php echo $i; ?>"<?php if ($i == 0) { echo ' class="active"'; } ?>><a class="switch" switch="<?php echo $i; ?>" href="#"><?php echo $i+1; ?></a></li><?php
		} ?>
		</ul><?php
	} ?>
</div>
</div>
<?php
wp_reset_query();
	}
}
?>
