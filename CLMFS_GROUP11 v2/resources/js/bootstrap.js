import axios from 'axios';
import Alpine from 'alpine';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Configure Axios
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Initialize GSAP plugins
gsap.registerPlugin(ScrollTrigger);
window.gsap = gsap;

// Expose to global scope
window.Alpine = Alpine;
