import React from 'react';
import ReactDOM from 'react-dom';
import MetaboxGallery from './MetaboxGallery';

require('../../scss/canvas-admin.scss');

(($) => {

  $(() => {

    window.$ = $;

    const galleryMetabox = document.getElementById('canvas-gallery-images');
    
    if (galleryMetabox) {
      ReactDOM.render(<MetaboxGallery />, galleryMetabox);
    }

  });
  
})(jQuery);