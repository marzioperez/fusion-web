import './bootstrap';
import './components.js';

import { loadStripe } from '@stripe/stripe-js';
import stripeCheckoutModal from './stripe-checkout-modal';

window.loadStripe = loadStripe;
window.stripeCheckoutModal = stripeCheckoutModal;
