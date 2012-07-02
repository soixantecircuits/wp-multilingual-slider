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


function home_slider($nbrposts) {

	if (ICL_LANGUAGE_CODE == 'en') 
	{ 
		$frSlides = json_decode(get_option("home_content_en"));
	}
	else
	{
		$frSlides = json_decode(get_option("home_content_fr"));
	}
	$nbrElems=count($frSlides);
	if (count($nbrElems)>0) :
?>
	 <div class="flexslider">
        <ul class="slides">
<?php
			for ($i=0; $i<$nbrElems && $i<$nbrposts;$i++) :
			if ($i%3==0) :
				$the_title= $frSlides[$i]->value;
				$the_image_url= $frSlides[$i+1]->value;
				$the_url= $frSlides[$i+2]->value;
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
