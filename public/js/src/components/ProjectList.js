import React, { Component } from 'react';

export default class ProjectList extends Component {
  render() {
    return (
      <div className="canvas-project-list">
        {this.props.projects.map(this.createProjectItem)}
      </div>
    );
  }

  createProjectItem(project) {
    const images = project._embedded['wp:featuredmedia'];
    return (
      <div key={project.id} className="canvas-project-list-item">
        <img src={images[0].media_details.sizes.medium_large.source_url} />
        <h4>{project.title.rendered}</h4>
      </div>
    );
  }
}