import React, { Component } from 'react';
import ProjectListItem from './ProjectListItem';

export default class ProjectList extends Component {
  render() {
    return (
      <div className="canvas-project-list">
        {this.props.projects.map((project) => {
          return <ProjectListItem key={project.id} {...project} />
        })}
      </div>
    );
  }
}