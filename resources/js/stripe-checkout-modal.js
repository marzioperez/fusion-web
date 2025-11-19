import { loadStripe } from '@stripe/stripe-js';

export default function stripeCheckoutModal(publishableKey) {
    return {
        isOpen: false,
        loading: false,
        error: null,
        stripe: null,
        elements: null,
        card: null,
        clientSecret: null,
        orderId: null,

        async open({ clientSecret, orderId }) {
            this.isOpen = true;
            this.error = null;
            this.clientSecret = clientSecret;
            this.orderId = orderId;

            if (!this.stripe) {
                this.stripe = await loadStripe(publishableKey);
                this.elements = this.stripe.elements();
                this.card = this.elements.create('card');
                this.card.mount('#card-element');
            }
        },

        close() {
            if (this.loading) return;
            this.isOpen = false;
        },

        async submit() {
            this.loading = true;
            this.error = null;

            const { error, paymentIntent } = await this.stripe.confirmCardPayment(
                this.clientSecret,
                {
                    payment_method: {
                        card: this.card,
                    },
                }
            );

            this.loading = false;

            if (error) {
                this.error = error.message ?? 'There was an error with your payment.';
                return;
            }

            if (paymentIntent && paymentIntent.status === 'succeeded') {
                // Aquí puedes redirigir a la página de éxito
                window.location.href = `/thank-you?order=${this.orderId}`;
            }
        },
    };
}
