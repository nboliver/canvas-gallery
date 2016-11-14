<?php 
  $images = stripslashes( get_post_meta( get_the_ID(), $this->plugin_name . '_gallery_images', true ) );
?>
<script id="canvas-gallery-image-data" type="application/json">
  <?php echo $images; ?>
</script>

<div id="canvas-gallery-images" class="canvas-gallery-images">
</div>

<p class="hide-if-no-js canvas-add-gallery-images-wrap">
  <a title="Add gallery images" href="#" class="canvas-add-gallery-images"><?php _e( 'Manage project images', 'canvas' ); ?></a>
</p>