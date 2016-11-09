<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/admin/partials
 */
?>

<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

<form method="post" name="canvas_settings" action="options.php">

  <?php
    //Grab option values
    $options = get_option( $this->plugin_name );

    $comments = $options['comments'];
  ?>

  <?php settings_fields( $this->plugin_name ); ?>

  <fieldset>
    <legend class="screen-reader-text"><span>Allow comments on projects</span></legend>
    <label for="<?php echo $this->plugin_name; ?>-comments">
      <input type="checkbox" id="<?php echo $this->plugin_name; ?>-comments" name="<?php echo $this->plugin_name; ?>[comments]" value="1" <?php checked( $comments, 1 ); ?> />
      <span><?php esc_attr_e( 'Allow comments on all projects', $this->plugin_name ); ?></span>
    </label>
  </fieldset>
  <?php submit_button( 'Save all changes', 'primary', 'submit', TRUE ); ?>
</form>
