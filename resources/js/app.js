import './bootstrap';
import Alpine from 'alpinejs';
import axios from 'axios';
import Swal from 'sweetalert2';

// Make Alpine available globally
window.Alpine = Alpine;
// Make Axios available globally
window.axios = axios;
// Make SweetAlert2 available globally
window.Swal = Swal;

// Set default headers for Axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Start Alpine
Alpine.start();
