import React from 'react';
import ReactDOM from 'react-dom';
import ProjectsContainer from './containers/ProjectsContainer';

require('../../scss/canvas-public.scss');

const portfolioIndex = document.getElementById('canvas-portfolio-index');

if (portfolioIndex) {
  ReactDOM.render(<ProjectsContainer />, portfolioIndex);
}