import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Splide from "@splidejs/splide";
window.Splide = Splide;

import flatpickr from "flatpickr";
import { Spanish } from "flatpickr/dist/l10n/es.js";
flatpickr.localize(Spanish);
window.flatpickr = flatpickr;
