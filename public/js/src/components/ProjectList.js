import React, { Component } from 'react';
import ProjectListItem from './ProjectListItem';

export default class ProjectList extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="canvas-project-list">
        {this.props.projects.map((project) => {
          return (
            <ProjectListItem
              {...project}
              key={project.id}
              onShowProject={this.props.onShowProject}
            />
          );
        })}

        {this.props.activeProject && this.props.activeProject.id}
      </div>
    );
  }
}