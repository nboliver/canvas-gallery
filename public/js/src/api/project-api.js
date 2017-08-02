import fetch from 'isomorphic-fetch';
import * as endpoints from '../endpoints';

function getProjects() {
  // TODO: Make this take query params for filtering?
  return fetch(endpoints.projectsUrl).then(response => response.json());
}

function getProject(id) {
  return fetch(endpoints.getProjectUrl(id)).then((response) => {
    console.log(endpoints.getProjectUrl(id));
    return response.json();
  });
}

export {
  getProjects,
  getProject,
};