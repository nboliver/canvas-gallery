<?php

/**
 * Projects Index
 *
 *
 * @link       http://nboliver.com
 * @since      1.0.0
 *
 * @package    Canvas
 * @subpackage Canvas/public/partials
 */
?>

<div id=canvas-portfolio-index></div>

<?php

$args = array(
  'post_type' => array($this->post_type['slug'])
);

$the_query = new WP_Query( $args );

//var_dump($the_query);
// The Loop
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  $images = json_decode( stripslashes( get_post_meta( get_the_ID(), $this->plugin_name . '_gallery_images', true ) ) );
  foreach ( $images as $image ) {
    //var_dump($image);
    //echo '<img src="' . $image->sizes->medium->url . '" />';
  }
endwhile;
endif;
// Reset Post Data
wp_reset_postdata();
?>