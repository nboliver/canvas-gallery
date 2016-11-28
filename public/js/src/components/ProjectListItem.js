import React, { Component } from 'react';

export default class ProjectListItem extends Component {
  render() {
    const { id, title } = this.props;
    const thumbUrl = this.getThumbnail(this.props._embedded['wp:featuredmedia']);

    return (
      <div key={id} className="canvas-project-list-item">
        <img src={thumbUrl} />
        <h4>{title.rendered}</h4>
      </div>
    );
  }

  getThumbnail(images) {
    let thumbUrl;
    
    if (images !== undefined) {
      const imageSizes = images[0].media_details.sizes;
      const sizes = ['medium_large', 'medium', 'thumbnail'];

      sizes.some((size) => {
        thumbUrl = imageSizes[size];
        return imageSizes.hasOwnProperty(size);
      });

      thumbUrl = thumbUrl.source_url
      
    } else {
      thumbUrl = 'http://placehold.it/350x350';
    }

    return thumbUrl;
  }
}