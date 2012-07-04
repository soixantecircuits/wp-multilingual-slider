<?php
/*
Plugin Name: Image accueil
Plugin URI: http://www.soixantecircuits.fr/
Description: Permet de gérer les images en fonction des langues afin de les utiliser dans un slider par example
Author: Soixante circuit
Version: 1.1
Author URI: http://www.soixantecircuits.fr/
*/

require( dirname(__FILE__) . '/admin-menu.php' );
// Activation de l'extension
add_action( 'plugins_loaded', 'xb_classifieds_init' );

function xb_classifieds_init() {
	// Add permission on role during the plugin activation
	register_activation_hook ( __FILE__, 'xb_classifieds_build_permissions' );
	wp_enqueue_script( 'home_switcher', plugin_dir_url(__FILE__).'js/home_switcher.js', array('jquery'), 0.1, TRUE );
	
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


function print_home_slider($nbrposts) {
	$slides = get_option("home_content");
	$lang = 'fr';
	if (function_exists('qtrans_getLanguage')) {

	  	$lang = qtrans_getLanguage();
	} else if (function_exists('icl_get_languages')) {
		$lang = icl_get_languages();
	}
	$slides = json_decode($slides[$lang]);
	$nbElems = count($slides);
	if ($nbElems > 0) {
?>
<div id="content">
<div class="block-gallery">
	<div class="gallery">
	<ul>
	<?php
		for ($i = 0; $i < $nbElems/5; $i++) {
			$the_title = $slides[$i*5]->{'value'};
			$the_sub = $slides[$i*5+1]->{'value'};
			$the_legend = $slides[$i*5+2]->{'value'};
			$the_url = $slides[$i*5+3]->{'value'};
			$the_img = $slides[$i*5+4]->{'value'};
	?>
		<li id="slide-<?php echo $i;?>"<?php if ($i == 0) { echo ' class="active"'; } ?>>
			<div class="area">
				<img class="png" src="<?php echo $the_img; ?>" alt="image description" width="488" height="306" />
				<strong><?php echo $the_title; ?></strong>
			</div>
			<div class="info-panel">
				<strong class="location"><?php echo $the_title; ?></strong>
				<div class="holder">
					<h2><?php echo $the_sub; ?></h2>
					<p><?php echo $the_legend; ?></p>
				</div>
				<a href="<?php echo $the_url; ?>" class="link">en savoir</a>
			</div>
		</li><?php 
		} 
		?>
	</ul>
	</div>
	
	<?php 
	if ($nbElems > 0) { ?>
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
