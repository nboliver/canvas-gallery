import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MetaboxGalleryItem from './MetaboxGalleryItem';

export default class MetaboxGallery extends Component {
  constructor() {
    super();

    this.frame;
    this.l10n = window.canvas_l10n;
    this.gridClass = 'canvas-gallery-image-grid';
    this.state = {
      images: JSON.parse($('#canvas-gallery-image-data').html())
    };

    this._bindEvents();
  }

  _bindEvents() {
    $(document).on('click', '.canvas-add-gallery-images, .canvas-gallery-item-image', (event) => {
      event.preventDefault();

      this._renderMediaUploader();

      // bind media uploader's events after it's rendered
      this._bindFrameEvents();
    });
  }

  _renderMediaUploader() {
    // Frame already exists, so open it and bail
    if (this.frame !== undefined) {
      this.frame.open();
      
      return;
    }

    const attributes = {
      title: this.l10n.gallery_manager_title,
      frame: 'select',
      multiple: 'add',
      button: {
        text: this.l10n.gallery_manager_button,
      }
    };

    // Frame doesn't exist, so set it up
    this.frame = wp.media.frames.canvasGallery = wp.media(attributes);

    // now it's set up, open it
    this.frame.open();

    // pre-select initial active images
    this._setFrameSelection();
  }

  _bindFrameEvents() {
    if (this.frame === undefined) return;

    this.frame.on('open', () => {
      this._setFrameSelection();
    });

    this.frame.on('select', () => {
      this.setState({images: this.frame.state().get('selection').toJSON()});
    });
  }

  _setFrameSelection() {
    const selection = this.frame.state().get('selection');
    const ids = this.state.images.map((image) => { return image.id; });

    ids.forEach((id) => {
      const attachment = wp.media.attachment(id);
      attachment.fetch();
      selection.add( attachment ? [ attachment ] : [] );
    });
  }

  componentDidMount() {
    $(`.${this.gridClass}`).sortable({
      update: (event, ui) => {
        const sortedIds = [];
        const sortedImages = [];

        // Create an array of ids in the new / sorted order
        $(event.target).children('.canvas-gallery-item').each((index, element) => {
          sortedIds.push(parseInt($(element).attr('data-id'), 10));
        });

        // Build new images array based on sort order
        sortedIds.forEach((id) => { 
          // TODO switch to native .find
          const image = _.find(this.state.images, (image) => {
            return image.id === id;
          });

          sortedImages.push(image);
        });
        
        this.setState({images: sortedImages});
      }
    });

    $(`.${this.gridClass}`).disableSelection();
  }

  render() {
    const galleryData = JSON.stringify(this.state.images);
    return (
      <div className={this.gridClass}>
        {this.state.images.map((image) => (
          <MetaboxGalleryItem key={image.id} {...image} />
        ))}
        <input type="hidden" id="canvas-gallery-selected-images" name="canvas-gallery-selected-images" value={galleryData} />
      </div>
    )
  }
}
