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
      console.log(this.state);
    });
  }

  render() {
    return (
      <ProjectList projects={this.state.projects} />
    )
  }
}