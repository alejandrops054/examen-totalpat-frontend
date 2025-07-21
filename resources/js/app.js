import './bootstrap';

const baseUrlMeta = document.querySelector('meta[name="base-url"]');
if (baseUrlMeta) {
    window.axios.defaults.baseURL = baseUrlMeta.getAttribute('content');
}
