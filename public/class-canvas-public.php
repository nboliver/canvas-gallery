<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Canvas
 * @subpackage Canvas/public
 * @author     Nic Oliver <nic@nboliver.com>
 */
class Canvas_Public {

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
   * The custom post types used by the plugin.
   *
   *
   * @since    1.0.0
   * @access   private
   * @var      array    $post_type    Custom post type settings.
   */
  private $post_type;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version, $post_type ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->post_type = $post_type;

  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    wp_enqueue_style( 
      $this->plugin_name, 
      plugin_dir_url( __FILE__ ) . 'css/canvas-public.css', 
      array(), 
      $this->version, 
      'all' 
    );

  }

  /**
   * Register the JavaScript for the public-facing side.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    wp_register_script( 
      $this->plugin_name, 
      plugin_dir_url( __FILE__ ) . 'js/canvas-public.js', 
      array( 'jquery' ), 
      $this->version, 
      true 
    );

    $translations = array(
      'post_type_slug' => $this->post_type['slug'],
    );

    wp_localize_script( $this->plugin_name, $this->plugin_name, $translations );

    wp_enqueue_script( $this->plugin_name );

  }

  /**
   * Register the JavaScript for the public-facing side.
   *
   * @since    1.0.0
   */
  public function render_projects_index() {
    
    include_once( 'partials/canvas-projects-index.php' );

  }

}
