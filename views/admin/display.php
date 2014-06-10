<?php
if ( isset($_POST["debug_type"]) ) {
  wpms_debug_mode(intval($_POST["debug_type"]));
  update_option("wp_multilingual_slider_debug_type", $_POST["debug_type"]);
}

function wpms_debug_mode($debug_type){
  switch ($debug_type) {
    case 0:
      $debug = false;
      $debug_log = false;
      $debug_display = false;
      break;
    case 1:
      $debug = true;
      $debug_log = true;
      $debug_display = true;
      break;
    case 2:
      $debug = true;
      $debug_log = true;
      $debug_display = false;
      break;
  }
  define('WP_DEBUG', $debug);
  define('WP_DEBUG_LOG', $debug_log);
  define('WP_DEBUG_DISPLAY', $debug_display);
}
function wpms_display($sel_lang) {
  wpms_version();
  ?>
  <div class="wrap">
  <i class="coco"></i><h1><?php _e("Coco slider - Bring easy multilingual sliding to wordpress","wp-multilingual-slider")?></h1>
  <div id="tabs">
  <ul class="tab_select">
    <li><a href="#tabs-slides"><?php _e('Slides', 'wp-multilingual-slider'); ?></a></li>
    <li><a href="#tabs-options"><?php _e('Options', 'wp-multilingual-slider'); ?></a></li>
    <li><a href="#tabs-import"><?php _e('Import/Export', 'wp-multilingual-slider'); ?></a></li>
    <li><a href="#tabs-debug"><?php _e('Debug', 'wp-multilingual-slider'); ?></a></li>
  </ul>
  <div id="tabs-slides">
    <div class="wrap">
      <h2><?php _e("Slides content", 'wp-multilingual-slider');?> </h2>
      <p> <?php _e("This page allow you to add images, links and title ! Look Ma ! you can also add video", 'wp-multilingual-slider');?>&nbsp;<?php echo get_bloginfo('name'); ?>
        <a href="<?php echo site_url(); ?>" type="button" target="_blank" class="button-secondary"><?php _e("See slider page", "wp-multilingual-slider"); ?></a>
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
            <h3><img class="flags" src="<?php echo WPMS_DIR; ?>/images/flags/64/<?php echo strtoupper(substr ( $l, 0, 2)) ?>.png"/> <?php _e("Slide for ", "wp-multilingual-slider"); ?> <?php _e($lang_codes[$l]);?> :</h3>
            <p><?php _e('To add a slide in', 'wp-multilingual-slider'); echo " " . $l;?> <?php _e('click on <i>Add a slide ', 'wp-multilingual-slider');?> <?php echo _e($lang_codes[$l]);?></i></p>
            <button type="button" name="button_<?php echo $l;?>" code_pays="<?php echo $l;?>" id="add_slide-<?php echo $l; ?>" class="add button-primary">
              <?php echo (__("Add a slide", 'wp-multilingual-slider')." ".$l); ?>
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
                      <th scope="row"><?php _e('Title', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <input id="_title_" class="title-<?php echo $l; ?>" name="_title_" value="<?php echo $slides[$i*6]->{'value'}; ?>" />
                      </td>
                    </tr>

                    <tr align="left">
                      <th scope="row"><?php _e('Subtitle', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <input id="_sub_" class="sub-<?php echo $l; ?>" name="_sub_" value="<?php echo $slides[$i*6+1]->{'value'}; ?>" />
                      </td>
                    </tr>

                    <tr align="left">
                      <th scope="row"><?php _e('Legend', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <input id="_legend_" class="legend-<?php echo $l; ?>" name="_legend_" value="<?php echo $slides[$i*6+2]->{'value'}; ?>" />
                      </td>
                    </tr>

                    <tr align="left">
                      <th scope="row"><?php _e('Link', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <input id="_url_" class="url-<?php echo $l; ?>" name="_url_" value="<?php echo $slides[$i*6+3]->{'value'}; ?>" />
                      </td>
                    </tr>

                    <tr align="left">
                      <th scope="row"><?php _e('Image', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <a id="_content-add_media_" class="thickbox add_media-<?php echo $l; ?>" onclick="return false;"
                           title="Add Media" href="media-upload.php?post_id=0&TB_iframe=1"><?php  _e('Insert an image', 'wp-multilingual-slider'); ?></a>
                        <input id="_image_" class="image-<?php echo $l; ?>" name="_image_" value="<?php echo $slides[$i*6+4]->{'value'}; ?>" type="hidden" />
                        <?php if ($slides[$i*6+4]->{'value'} != '') { ?>
                          <p class="img_home">
                            <img title="img-<?php echo $i; ?>" src="<?php echo $slides[$i*6+4]->{'value'}; ?>" />
                          </p>
                        <?php } ?>
                      </td>
                    </tr>

                    <tr align="left">
                      <th scope="row"><?php _e('External content', 'wp-multilingual-slider'); ?> :</th>
                      <td>
                        <input id="_ext_" class="ext-<?php echo $l; ?>" name="_ext_" value="<?php echo $slides[$i*6+5]->{'value'}; ?>" />
                      </td>
                    </tr>

                    <tr>
                      <th>
                        <a id="_up_" class="up-<?php echo $l; ?>" onclick="return false;" href="#"><?php _e('Up', 'wp-multilingual-slider'); ?></a>
                        /
                        <a id="_down_" class="down-<?php echo $l; ?>" onclick="return false;" href="#"><?php _e('Down', 'wp-multilingual-slider'); ?></a>
                      </th>
                      <td>
                        <button id="_remove_table_" class="remove_table-<?php echo $l; ?> button-primary" name="_form-table_"
                                style="border-color:#FF4D1A;background:#FF4D1A;float:right;" type="button"><?php _e('Delete', 'wp-multilingual-slider'); ?></button>
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

      <form id="home_handler" method="post" action="/">
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
          <button type="button" id="save_home" style="background:#33AA22;color:#FFF" class="button-primary"><?php _e('Save', 'wp-multilingual-slider') ?></button>
        </p>
      </form>
    </div>
  </div>
  <div id="tabs-options">
    <h2><?php _e("Slider's option", 'wp-multilingual-slider');?></h2>
    <div class="container">
      <form id="home_themes" method="post" action="/">
        <div class="param hide">
          <?php settings_fields('home-settings-select'); ?>
        </div>
        <div id="selector" class="selector">
          <a href="<?php echo site_url(); ?>" type="button" target="_blank" class="button-secondary"><?php _e("See slides", "wp-multilingual-slider"); ?></a>
          <?php wpms_get_all_themes(); ?>
        </div>
      </form>
      <?php
      if (function_exists("print_options")) {
        init_print_options();
      } ?>
    </div>
  </div>


  <div id="tabs-import">
    <h2><?php _e("Import or export your slides", 'wp-multilingual-slider');?></h2>
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
      <button type="button" class="io_button" id="load_json"><?php _e("Import slide to JSON format", "wp-multilingual-slider"); ?></button>
    </form>
    <hr />
    <button type="button" class="io_button" id="save_json"><?php _e("Export slide to JSON format", "wp-multilingual-slider"); ?></button>
  </div>

  <div id="tabs-debug">
    <h3><?php echo __('Debug', 'wp-multilingual-slider') ?></h3>

    <?php
    // Dropdown with debug options

    // Debug type. 0 = no debug, 1 = debug for admins only, 2 = debug for all
    $option = get_option("wp_multilingual_slider_debug_type");
    $debug_type = ($option != FALSE) ? (int) $option : "0";
    // capability edit_themes
    ?>
    <form action="" method="post">
      <?php settings_fields('home-settings-group'); ?>
      <?php
      printf('
					<p>
						<select name=debug_type>
							<option value=0 %1$s>%4$s</option>
							<option value=1 %2$s>%5$s</option>
							<option value=2 %3$s>%6$s</option>
						</select>
					</p>
					',
          $debug_type === 0 ? "selected" : "",
          $debug_type === 1 ? "selected" : "",
          $debug_type === 2 ? "selected" : "",
          __("Don't enable debug output", "wp_multilingual_slider"),
          __("Enable debug output and save to file", "wp_multilingual_slider"),
          __("Enable debug without output, only save to file", "wp_multilingual_slider")
      );
      ?>

      <p>
        <input class="button" type=submit value="<?php _e("Save changes", "wp-multilingual-slider") ?>">
      </p>

      <!--      --><?php //wp_nonce_field( "save-debug-options" ) ?>

    </form><!-- // enable debug -->
  </div>
  </div>
  </div>
<?php
}