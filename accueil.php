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

add_filter('the_content','print_home_slider');

function print_home_slider($nbrposts) {
	$slides = get_option("home_content");
	if (function_exists('qtrans_getLanguage')) {
		echo 'qtranslate';
	} else if (function_exists('ICL_LANGUAGE_CODE')) {
		echo 'wpml';
	}
	if (ICL_LANGUAGE_CODE == 'en') 
	{ 
		$slides = json_decode(get_option("home_content[en]"));
	}
	else
	{
		$slides = json_decode(get_option("home_content[fr]"));
	}
	$nbrElems=count($slides);
	if (count($nbrElems)>0) :
?>
	 <div class="flexslider">
        <ul class="slides">
<?php
			for ($i=0; $i<$nbrElems && $i<$nbrposts;$i++) :
			if ($i%3==0) :
				$the_title= $slides[$i]->value;
				$the_image_url= $slides[$i+1]->value;
				$the_url= $slides[$i+2]->value;
?>         
			<li>
			<a href="<?php echo $the_url; ?>">
			<img src="<?php echo $the_image_url; ?>" class="home-slider-thumbnail" />
				<div class="flex-caption">
				     <div class="holder">
				        <strong><?php echo $the_title; ?></strong>
				    </div>
				</div>
			</a>
			</li>
<?php 
		endif;
	endfor;
?>
		</ul>
	</div>

	<script>
	acceuil_plugin_flexslider = 
	{
			 directionNav: false
			 ,slideshowSpeed: 4000
			 ,animationDuration: 700
	};
	</script>
<?php
endif;
wp_reset_query();
}

?>
