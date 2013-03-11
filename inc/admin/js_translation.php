<?php
function wpms_js_translation() {
	$js_array = array (
		"title"	=> __('Title', 'wp-multilingual-slider'),
		"sub"		=> __('Subtitle', 'wp-multilingual-slider'),
		"leg"		=> __('Legend', 'wp-multilingual-slider'),
		"url"		=> __('Link', 'wp-multilingual-slider'),
		"img"		=> __('Image', 'wp-multilingual-slider'),
		"upld"	=> __('Insert an image', 'wp-multilingual-slider'),
		"up"		=> __('up', 'wp-multilingual-slider'),
		"down"	=> __('Down', 'wp-multilingual-slider'),
		"del"		=> __('Delete', 'wp-multilingual-slider'),
		"savbut"	=> __('Save', 'wp-multilingual-slider'),
		"save"	=> __('Saving...', 'wp-multilingual-slider'),
		"saverr"	=> __("Oups, an error occured :( ...", 'wp-multilingual-slider'),
		"saved"	=> __('Saved', 'wp-multilingual-slider'),
		"ext"		=> __('External content', 'wp-multilingual-slider'),
		"empty"	=> __('Please fill the json input form', 'wp-multilingual-slider'),
		"jsonformat"	=> __('This is not a json', 'wp-multilingual-slider'),
		"themes_name" => basename(get_template_directory("Name"))
	); ?>
	<script type="text/javascript">
		var loc = <?php echo json_encode($js_array); ?>;
	</script><?php
}