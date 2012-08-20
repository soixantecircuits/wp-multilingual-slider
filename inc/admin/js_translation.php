<?php

function wpms_js_translation() {
	$js_array = array (
		"title"	=> __('Titre', 'wp-multilingual-slider'),
		"sub" 	=> __('Sous-titre', 'wp-multilingual-slider'),
		"leg"		=> __('Légende', 'wp-multilingual-slider'),
		"url"		=> __('Lien', 'wp-multilingual-slider'),
		"img"		=> __('Image', 'wp-multilingual-slider'),
		"upld"	=> __('Inserer une image', 'wp-multilingual-slider'),
		"up"		=> __('Monter', 'wp-multilingual-slider'),
		"down"	=> __('Descendre', 'wp-multilingual-slider'),
		"del"		=> __('Supprimer', 'wp-multilingual-slider'),
		"savbut"	=> __('Sauvegarder', 'wp-multilingual-slider'),
		"save"	=> __('Sauvegarde en cours', 'wp-multilingual-slider'),
		"saverr"	=> __("Oups, une erreur s'est produite :( ...", 'wp-multilingual-slider'),
		"saved"	=> __('Sauvegardé', 'wp-multilingual-slider'),
		"ext"		=> __('Contenu externe', 'wp-multilingual-slider'),
		"empty"	=> __('Veuillez inserer un slide au format JSON', 'wp-multilingual-slider'),
	); ?>
	<script type="text/javascript">
		var loc = <?php echo json_encode($js_array); ?>;
	</script><?php
} ?>
