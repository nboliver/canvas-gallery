<?php

/**
 * Register taxonomies for the custom post type
 *
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/admin/partials
 */

$labels = array(
  'name'                       => __( 'Project Categories', 'canvas' ),
  'singular_name'              => __( 'Project Category', 'canvas' ),
  'menu_name'                  => __( 'Project Categories', 'canvas' ),
  'edit_item'                  => __( 'Edit Project Category', 'canvas' ),
  'update_item'                => __( 'Update Project Category', 'canvas' ),
  'add_new_item'               => __( 'Add New Project Category', 'canvas' ),
  'new_item_name'              => __( 'New Project Category Name', 'canvas' ),
  'parent_item'                => __( 'Parent Project Category', 'canvas' ),
  'parent_item_colon'          => __( 'Parent Project Category:', 'canvas' ),
  'all_items'                  => __( 'All Project Categories', 'canvas' ),
  'search_items'               => __( 'Search Project Categories', 'canvas' ),
  'popular_items'              => __( 'Popular Project Categories', 'canvas' ),
  'separate_items_with_commas' => __( 'Separate project categories with commas', 'canvas' ),
  'add_or_remove_items'        => __( 'Add or remove project categories', 'canvas' ),
  'choose_from_most_used'      => __( 'Choose from the most used project categories', 'canvas' ),
  'not_found'                  => __( 'No project categories found', 'canvas' )
);

$args = array(
  'labels'            => $labels,
  'public'            => true,
  'show_ui'           => true,
  'show_in_nav_menus' => true,
  'show_admin_column' => true,
  'show_tagcloud'     => false,
  'hierarchical'      => true,
  'query_var'         => true,
  'rewrite'           => array( 'slug' => 'portfolio-category', 'with_front' => false, 'hierarchical' => true )
);

register_taxonomy( 'portfolio-category', 'canvas_portfolio', $args );
