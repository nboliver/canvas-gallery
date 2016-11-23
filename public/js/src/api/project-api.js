import fetch from 'isomorphic-fetch';
import { WP_URL } from '../wp-url';

export function getProjects() {
  return fetch(WP_URL).then(response => response.json());
}