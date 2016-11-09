<p class="hide-if-no-js">
  <a title="Add gallery images" href="#" id="add-gallery-images"><?php _e( 'Add gallery images', $this->plugin_name ); ?></a>
</p>

<?php 

$images = get_post_meta( get_the_ID(), $this->plugin_name . '_gallery', true );

var_dump($images);