import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class MetaboxGalleryItem extends Component {
  constructor(props) {
    super(props);
    this.imageStyle = {
      backgroundImage: `url(${this.props.image.url})`
    }
  }

  render() {
    return (
      <div className="canvas-gallery-item" data-id={this.props.image.id}>
        <div className="canvas-gallery-item-image" style={this.imageStyle}></div>
      </div>
    )
  }
}

