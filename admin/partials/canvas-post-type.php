<?php

/**
 * Register the custom post type
 *
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/admin/partials
 */

$labels = array(
  'name'               => __( 'Projects', 'canvas' ),
  'singular_name'      => __( 'Project', 'canvas' ),
  'menu_name'          => __( 'Portfolio', 'canvas' ),
  'name_admin_bar'     => __( 'Projects', 'canvas' ),
  'add_new'            => __( 'Add New', 'canvas' ),
  'add_new_item'       => __( 'Add New Project', 'canvas' ),
  'edit_item'          => __( 'Edit Project', 'canvas' ),
  'new_item'           => __( 'New Project', 'canvas' ),
  'view_item'          => __( 'View Project', 'canvas' ),
  'search_items'       => __( 'Search Projects', 'canvas' ),
  'not_found'          => __( 'No projects found', 'canvas' ),
  'not_found_in_trash' => __( 'No projects found in trash', 'canvas' ),
  'all_items'          => __( 'Projects', 'canvas' )
);

$supports = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' );
if ( get_option( $this->plugin_name )['comments'] ) {
  array_push( $supports, 'comments' );
}

$args = array(
  'labels'             => $labels,
  'description'        => __( 'Post type for portfolio / projects / case studies', 'canvas' ),
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'portfolio' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => 20,
  'show_in_rest'       => true,
  'menu_icon'          => 'dashicons-portfolio',
  'supports'           => $supports
);

register_post_type( $this->post_type['slug'], apply_filters( 'canvas_portfolio_post_type_args', $args ) );
