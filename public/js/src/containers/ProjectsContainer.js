import React, { Component } from 'react';
import * as projectApi from '../api/project-api';
import ProjectList from '../components/ProjectList';

export default class ProjectsContainer extends Component {
  constructor(props) {
    super(props);

    this.state = {
      projects: []
    }
  }

  componentDidMount() {
    projectApi.getProjects().then(projects => {
      this.setState({projects: projects});
    });
  }

  handleShowProject(id) {
    const project = this.state.projects.find(x => x.id === id);
    console.log(project);
    this.setState({activeProject: project});
  }

  render() {
    return (
      <ProjectList
        {...this.state}
        onShowProject={(id) => this.handleShowProject(id)}
      />
    )
  }
}