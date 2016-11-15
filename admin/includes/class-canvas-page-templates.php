<?php

/**
 * Sets up the plugins page templates
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/admin
 * @author     Nic Oliver <nic@nboliver.com>
 */

class Canvas_Page_Templates {

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
   * A reference to an instance of this class.
   *
   * @since    1.0.0
   * @access   protected
   */
  private static $instance;

  /**
   * The array of page templates this plugin is responsible for.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $templates    The array of templates.
   */
  protected $templates;

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
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param    string    $plugin_name       The name of this plugin.
   * @param    string    $version    The version of this plugin.
   */
  public function init_templates() {

    $this->templates = array();

    // Add a filter to the attributes metabox to inject template into the cache.
    add_filter(
      'page_attributes_dropdown_pages_args',
      array( $this, 'register_project_templates' )
    );

    // Add a filter to the save post to inject out template into the page cache
    add_filter(
      'wp_insert_post_data',
      array( $this, 'register_project_templates' )
    );

    // Add a filter to the template include to determine if the page has our 
    // template assigned and return it's path
    add_filter(
      'template_include',
      array( $this, 'view_project_template' )
    );

    $this->templates = array(
      '../templates/canvas-projects-index.php' => 'Canvas Projects Index',
    );

  }

  /**
   * Adds our template to the pages cache. This makes WP think
   * the template file exists when it doens't really exist.
   *
   * @since    1.0.0
   * @param    string    $atts       
   */
  public function register_project_templates( $atts ) {

    // Create the key used for the themes cache
    $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

    // Retrieve the cache list. 
    // If it doesn't exist, or it's empty prepare an array
    $templates = wp_get_theme()->get_page_templates();
    if ( empty( $templates ) ) {
      $templates = array();
    }

    // Preparing a new cache, so remove the old one
    wp_cache_delete( $cache_key , 'themes');

    // Now add our template to the list of templates by merging our templates
    // with the existing templates array from the cache.
    $templates = array_merge( $templates, $this->templates );

    // Add the modified cache to allow WordPress to pick it up for listing
    // available templates
    wp_cache_add( $cache_key, $templates, 'themes', 1800 );
    
    return $atts;
  }

  /**
   * Checks if a template is assigned to a page.
   *
   * @since    1.0.0
   * @param    string    $atts       
   */
  public function view_project_template( $template ) {

    // Get global post
    global $post;

    // Return template if post is empty
    if ( ! $post ) {
      return $template;
    }

    // Return default template if we don't have a custom one defined
    $active_template = get_post_meta( $post->ID, '_wp_page_template', true );
    if ( ! isset( $this->templates[$active_template] ) ) {
      return $template;
    }

    $file = plugin_dir_path(__FILE__). get_post_meta( 
      $post->ID, '_wp_page_template', true
    );

    // Check if the template file exists.
    if ( file_exists( $file ) ) {
      return $file;
    } else {
      echo $file;
    }

    return $template;
  }

}
