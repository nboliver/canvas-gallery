const baseUrl = document.querySelectorAll('[rel="https://api.w.org/"]')[0].getAttribute('href');
const postTypeSlug = window.canvas.post_type_slug;

export const WP_URL = `${baseUrl}wp/v2/${postTypeSlug}?_embed`;