const WP_URL = document.querySelectorAll('[rel="https://api.w.org/"]')[0].getAttribute('href');
const postTypeSlug = window.canvas.post_type_slug;

const projectsUrl = `${WP_URL}wp/v2/${postTypeSlug}?_embed`;

function getProjectUrl(id) {
  return `${WP_URL}wp/v2/${postTypeSlug}/${id}/?_embed`;
}

export {
  projectsUrl,
  getProjectUrl,
};