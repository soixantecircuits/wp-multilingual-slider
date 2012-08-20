<?php

function wpms_display($sel_lang) { ?>

<div class="wrap">
<div id="tabs">
    <ul class="tab_select">
      <li><a href="#tabs-slides"><?php _e('Contenus', 'wp-multilingual-slider'); ?></a></li>
      <li><a href="#tabs-options"><?php _e('Options', 'wp-multilingual-slider'); ?></a></li>
      <li><a href="#tabs-import"><?php _e('Importer/Exporter', 'wp-multilingual-slider'); ?></a></li>
    </ul>

<div id="tabs-options">
    <h2><?php _e("Options de l'accueil", 'wp-multilingual-slider');?></h2>
	<form id="home_themes" method="post" action="options.php">
		<?php settings_fields('home-settings-select'); ?>
		<a href="<?php echo site_url(); ?>" type="button" target="_blank" class="button-secondary"><?php _e("Voir la page", "wp-multilingual-slider"); ?></a>
		<select id="select_themes" name="home_themes">
			<?php wpms_get_all_themes(); ?>
		</select>
	</form>
	<?php
	if (function_exists("print_options")) {
		init_print_options();
	} ?>
</div>

<div id="tabs-import">
	<h2><?php _e("Importer ou exporter des slides", 'wp-multilingual-slider');?></h2>
	<form id="json_handler" method="post" action="options.php">
		<?php settings_fields('home-settings-group'); ?>

		<?php 
		if(!empty($sel_lang)) {
			foreach($sel_lang as $l) { ?>
				<input type="hidden" id="json_content[<?php echo $l;?>]" name="home_content[<?php echo $l;?>]" type="text" /><?php
			}
		} ?>

		<textarea id="data_json"></textarea>
		<br />
		<button type="button" class="io_button" id="load_json"><?php _e("Importer les slides au format JSON", "wp-multilingual-slider"); ?></button>
	</form>
	<hr />
	<button type="button" class="io_button" id="save_json"><?php _e("Exporter les slides au format JSON", "wp-multilingual-slider"); ?></button>
</div>

<div id="tabs-slides">
    <div class="wrap">
    <h2><?php _e("Contenu des slides", 'wp-multilingual-slider');?> </h2>
    <p> <?php _e("Cette page vous permet d'ajouter des images et des liens à la page d'accueil du site", 'wp-multilingual-slider');?>&nbsp;<?php echo get_bloginfo('name'); ?>
		<a href="<?php echo site_url(); ?>" type="button" target="_blank" class="button-secondary"><?php _e("Voir la page", "wp-multilingual-slider"); ?></a>
	 </p>   

<?php 
if(!empty($sel_lang)){ 
	global $lang_codes;
	$home_content = 'home_content';
	$allSlides = get_option($home_content);?>
	<div id="columnizer">
<?php
    foreach($sel_lang as $l) { ?>
        <div id="column-<?php echo $l; ?>" class="column column-<?php echo count($sel_lang); ?>">
        <form id="content_home-<?php echo $l; ?>" class="content_home">
        <h3><img src="<?php echo WPMS_DIR; ?>/inc/admin/resources/images/<?php echo $l ?>.png"/> <?php _e("Page d'accueil en", "wp-multilingual-slider"); ?> <?php echo $lang_codes[$l];?> :</h3>
        <p><?php _e('Pour ajouter une diapositive en', 'wp-multilingual-slider'); echo " " . $l;?> <?php _e('cliquez sur <i>Ajouter un slide', 'wp-multilingual-slider');?> <?php echo $lang_codes[$l];?></i></p>
        <button type="button" name="button_<?php echo $l;?>" code_pays="<?php echo $l;?>" id="add_slide-<?php echo $l; ?>" class="add button-primary">
            <?php echo (__("Ajouter un slide", 'wp-multilingual-slider')." ".$l); ?>
        </button>
        <ul id="slide_list-<?php echo $l; ?>" class="slide_list">
        <span id="sentinel-<?php echo $l; ?>"></span>
<?php

		  if ($allSlides != null) {
        		$slides = json_decode($allSlides[$l]);
        $cpt = 0;
        for ($i = 0; $i < count($slides)/6; $i++) { ?>
            <table id="_" class="table-<?php echo $l; ?>">
             <tr align="left">
                <th scope="row"><?php _e('Titre', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <input id="_title_" class="title-<?php echo $l; ?>" name="_title_" value="<?php echo $slides[$i*6]->{'value'}; ?>" />
                </td>
             </tr>

             <tr align="left">
                <th scope="row"><?php _e('Sous-titre', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <input id="_sub_" class="sub-<?php echo $l; ?>" name="_sub_" value="<?php echo $slides[$i*6+1]->{'value'}; ?>" />
                </td>
             </tr>

             <tr align="left">
                <th scope="row"><?php _e('Légende', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <input id="_legend_" class="legend-<?php echo $l; ?>" name="_legend_" value="<?php echo $slides[$i*6+2]->{'value'}; ?>" />
                </td>
             </tr>

             <tr align="left">
                <th scope="row"><?php _e('Lien', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <input id="_url_" class="url-<?php echo $l; ?>" name="_url_" value="<?php echo $slides[$i*6+3]->{'value'}; ?>" />
                </td>
             </tr>

             <tr align="left">
                <th scope="row"><?php _e('Image', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <a id="_content-add_media_" class="thickbox add_media-<?php echo $l; ?>" onclick="return false;"
                        title="Add Media" href="media-upload.php?post_id=0&TB_iframe=1"><?php  _e('Inserer une image', 'wp-multilingual-slider'); ?></a>
                  <input id="_image_" class="image-<?php echo $l; ?>" name="_image_" value="<?php echo $slides[$i*6+4]->{'value'}; ?>" type="hidden" />
                  <?php if ($slides[$i*6+4]->{'value'} != '') { ?>
                    <p class="img_home">
                        <img title="img-<?php echo $i; ?>" src="<?php echo $slides[$i*6+4]->{'value'}; ?>" />
                    </p>
                  <?php } ?>
                </td>
             </tr>

             <tr align="left">
                <th scope="row"><?php _e('Contenu externe', 'wp-multilingual-slider'); ?> :</th>
                <td>
                  <input id="_ext_" class="ext-<?php echo $l; ?>" name="_ext_" value="<?php echo $slides[$i*6+5]->{'value'}; ?>" />
                </td>
             </tr>

             <tr>
                <th>
                  <a id="_up_" class="up-<?php echo $l; ?>" onclick="return false;" href="#"><?php _e('Monter', 'wp-multilingual-slider'); ?></a>
                    /
                  <a id="_down_" class="down-<?php echo $l; ?>" onclick="return false;" href="#"><?php _e('Descendre', 'wp-multilingual-slider'); ?></a>
                </th>
                <td>
                  <button id="_remove_table_" class="remove_table-<?php echo $l; ?> button-primary" name="_form-table_" 
                        style="border-color:#FF4D1A;background:#FF4D1A;float:right;" type="button"><?php _e('Supprimer', 'wp-multilingual-slider'); ?></button>
                </td>
             </tr>
        </table>
        <?php
        }
		  }
    ?></ul></form></div><?php
    }
}
?>
</div>

<form id="home_handler" method="post" action="options.php">
	<?php settings_fields('home-settings-group'); ?>

	<?php 
	if(!empty($sel_lang)) {
		foreach($sel_lang as $l) { ?>
			<input type="hidden" id="home_content[<?php echo $l;?>]" name="home_content[<?php echo $l;?>]" type="text" />
			<div id="code" code_pays="<?php echo $l;?>"></div>
		<?php
		}
	}
	?>

	<p class="submit">
		<button type="button" id="save_home" style="background:#33AA22;color:#FFF" class="button-primary"><?php _e('Sauvegarder', 'wp-multilingual-slider') ?></button>
	</p>
</form>
</div>
</div>
</div>
</div>
<?php
} ?>
