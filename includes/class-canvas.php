<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Canvas
 * @subpackage Canvas/includes
 * @author     Nic Oliver <nic@nboliver.com>
 */
class Canvas {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Canvas_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * The custom post types used by the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      array    $post_type    Custom post type settings.
   */
  protected $post_type;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {

    $this->plugin_name = 'canvas';
    $this->version = '1.0.0';
    $this->post_type = array(
      'slug' => 'canvas_portfolio',
    );

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->register_templates();
    $this->define_public_hooks();

  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Canvas_Loader. Orchestrates the hooks of the plugin.
   * - Canvas_i18n. Defines internationalization functionality.
   * - Canvas_Admin. Defines all hooks for the admin area.
   * - Canvas_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-canvas-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-canvas-i18n.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-canvas-admin.php';

    /**
     * The class responsible for setting up page templates.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-canvas-page-templates.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-canvas-public.php';

    $this->loader = new Canvas_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Canvas_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale() {

    $plugin_i18n = new Canvas_i18n();

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {

    $plugin_admin = new Canvas_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );

    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    // Add settings page
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_settings_page' );
    $this->loader->add_action( 'admin_init', $plugin_admin, 'update_settings' );

    // Add Settings link to the plugins listing
    $plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
    $this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

    // Add post type & taxonomies
    // TODO: Break this out into separate class
    $this->loader->add_action( 'init', $plugin_admin, 'register_post_type' );
    $this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy' );

    // Add metaboxes to projects
    // TODO Break out generic metabox to class and specific metaboxes to child classes
    $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );

    // Save metabox
    $this->loader->add_action( 'save_post', $plugin_admin, 'save_gallery_meta' );
  }

  /**
   * Register page templates used by the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function register_templates() {

    $page_templates = new Canvas_Page_Templates( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'plugins_loaded', $page_templates, 'init_templates' );
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks() {

    $plugin_public = new Canvas_Public( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    // Template hooks
    $this->loader->add_action( 'canvas_render_projects_index', $plugin_public, 'render_projects_index' );

  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Canvas_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

  /**
   * Retrieve the post type settings of the plugin.
   *
   * @since     1.0.0
   * @return    array    The post type settings.
   */
  public function get_post_type() {
    return $this->post_type;
  }

}
