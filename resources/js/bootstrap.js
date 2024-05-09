import axios from 'axios';
import 'bootstrap/dist/js/bootstrap.js';
import 'bootstrap/js/dist/popover.js';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

