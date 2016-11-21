<?php
/**
 * The project index template.
 *
 * Displays the master list of projects.
 *
 * @package    Canvas
 * @subpackage Canvas/admin
 * @author     Nic Oliver <nic@nboliver.com>
 * @since 1.0.0
 */

get_header(); ?>

  <?php do_action( 'canvas_render_projects_index' ); ?>

<?php get_footer(); ?>
