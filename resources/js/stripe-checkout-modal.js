import { loadStripe } from '@stripe/stripe-js';

export default function stripeCheckoutModal(publishableKey) {
    return {
        isOpen: false,
        loading: false,
        error: null,
        stripe: null,
        elements: null,
        cardNumber: null,
        cardExpiry: null,
        cardCvc: null,
        clientSecret: null,
        orderId: null,

        async open({ clientSecret, orderId }) {
            this.isOpen = true;
            this.error = null;
            this.clientSecret = clientSecret;
            this.orderId = orderId;

            if (!this.stripe) {
                this.stripe = await loadStripe(publishableKey);
            }

            this.$nextTick(() => {

                this.elements = this.stripe.elements();

                if (this.cardNumber) {
                    this.cardNumber.unmount();
                    this.cardNumber = null;
                }
                if (this.cardExpiry) {
                    this.cardExpiry.unmount();
                    this.cardExpiry = null;
                }
                if (this.cardCvc) {
                    this.cardCvc.unmount();
                    this.cardCvc = null;
                }

                const style = {
                    base: {
                        fontSize: '16px',
                        color: '#2B2B2B',
                        '::placeholder': {
                            color: '#a0aec0',
                        },
                    },
                };

                this.cardNumber = this.elements.create('cardNumber', { style });
                this.cardExpiry = this.elements.create('cardExpiry', { style });
                this.cardCvc    = this.elements.create('cardCvc', { style });

                this.cardNumber.mount('#card-number-element');
                this.cardExpiry.mount('#card-expiry-element');
                this.cardCvc.mount('#card-cvc-element');
            });
        },

        close() {
            if (this.loading) return;
            this.isOpen = false;
            if (this.cardNumber) {
                this.cardNumber.unmount();
                this.cardNumber = null;
            }
            if (this.cardExpiry) {
                this.cardExpiry.unmount();
                this.cardExpiry = null;
            }
            if (this.cardCvc) {
                this.cardCvc.unmount();
                this.cardCvc = null;
            }
        },

        async submit() {
            this.loading = true;
            this.error = null;

            const { error, paymentIntent } = await this.stripe.confirmCardPayment(
                this.clientSecret,
                {
                    payment_method: {
                        card: this.cardNumber,
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
