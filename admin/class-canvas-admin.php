<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Canvas
 * @subpackage Canvas/admin
 * @author     Nic Oliver <nic@nboliver.com>
 */
class Canvas_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * The custom post type slug.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $post_type_slug = 'canvas_portfolio';

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param    string    $plugin_name       The name of this plugin.
   * @param    string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Canvas_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Canvas_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/canvas-admin.css', array(), $this->version, 'all' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {
    // WP Media dependencies
    wp_enqueue_media();

    // Custom scripts
    wp_register_script( 
      $this->plugin_name, 
      plugin_dir_url( __FILE__ ) . 'js/canvas-admin.js', 
      array( 'jquery' ), 
      $this->version, 
      true 
    );

    $translations = array(
      'gallery_manager_title' => __( 'Manage Project Gallery Images', 'canvas' ),
      'gallery_manager_button' => __( 'Use selected images', 'canvas' ),
    );

    wp_localize_script( $this->plugin_name, 'canvas_l10n', $translations );

    wp_enqueue_script( $this->plugin_name );

  }

  /**
   * Register the plugin settings page
   *
   * @since    1.0.0
   */
  public function add_settings_page() {

    // TODO: translate this
    add_submenu_page(
      'edit.php?post_type=' . $this->post_type_slug,
      'Canvas Portfolio Settings',
      'Settings',
      'manage_options', 
      'settings', 
      array( $this, 'display_plugin_settings_page' )
    );

  }

  /**
   *
   * Add settings link to plugins list
   *
   *  @since  1.0.0
   */
  public function add_action_links( $links ) {

    $settings_link = array(
      '<a href="' . admin_url( 'edit.php?post_type=' . $this->post_type_slug . '&page=settings' ) . '">' . __('Settings', $this->plugin_name) . '</a>',
    );
    return array_merge( $settings_link, $links );

  }

  /**
   * Render the settings page for the plugin
   *
   * @since    1.0.0
   */
  public function display_plugin_settings_page() {
    include_once( 'partials/canvas-admin-display.php' );
  }

  /**
   *
   * admin/class-wp-cbf-admin.php
   *
   **/
  public function update_settings() {
    register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate_settings' ) );
  }

  /**
   *
   * Validate plugin settings
   *
   **/
  public function validate_settings( $input ) {
    // All checkboxes inputs      
    $valid = array();

    //Cleanup
    $valid['comments'] = ( isset( $input['comments'] ) && !empty( $input['comments'] ) ) ? 1 : 0;

    return $valid;
  }

  /**
   * Add custom post type
   *
   * @since    1.0.0
   */
  public function register_post_type() {
    include_once( 'partials/canvas-post-type.php' );
  }

  /**
   * Add taxonomies for custom post type
   *
   * @since    1.0.0
   */
  public function register_taxonomy() {
    include_once( 'partials/canvas-taxonomies.php' );
  }

  /**
   * Renders the gallery meta box.
   *
   * @since 0.1.0
   */
  public function add_meta_boxes() {
    $screens = array( $this->post_type_slug );

    foreach ( $screens as $screen ) {
      add_meta_box(
        $this->plugin_name . '_gallery',
        __ ( 'Project Images', 'canvas' ),
        array( $this, 'display_images_metabox' ),
        $screen,
        'advanced'
      );
    }
  }

  /**
   * Render the settings page for the plugin
   *
   * @since    1.0.0
   */
  public function display_images_metabox() {
    include_once( 'partials/canvas-images-metabox.php' );
  }

  /**
   * Save gallery images to post meta
   *
   * @param int $post_id The ID of the post with which we're currently working.
   * @since 1.0.0
   */
  public function save_gallery_meta( $post_id ) {
    if ( isset( $_REQUEST['canvas-gallery-selected-images'] ) ) {
      update_post_meta( 
        $post_id, 
        $this->plugin_name . '_gallery_images', 
        sanitize_text_field( wp_slash( $_REQUEST['canvas-gallery-selected-images'] ) )
      );
    }
  }

}
