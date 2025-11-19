<?php

namespace App\Livewire\Order\Checkout;

use App\Enums\Status;
use App\Models\Cart;
use App\Settings\GeneralSettings;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public Cart $cart;
    public $token;
    public $sub_total = 0, $total = 0, $processing_fee = 0;

    public $credits = 0;
    public $use_credits = false;
    public $credits_applied = 0;
    public $credits_remaining = 0;

    public $current_step = 2;

    public function mount() {
        $token = session()->get('cart-token');
        if ($token) {
            $this->token = $token;
            $this->load_cart();
        }
    }

    #[On('toggle-use-credits')]
    public function apply_credits($enabled) {
        $this->use_credits = $enabled;
        $this->load_cart();
    }

    #[On('cart-updated')]
    public function load_cart():void {
        $cart = Cart::where('token', $this->token)->where('status', Status::PENDING->value)->get()->last();
        if ($cart) {
            if ($this->use_credits) {
                $user = auth()->user();
                $settings = new GeneralSettings();
                $fee = $settings->processing_fee;

                $this->sub_total = $cart->sub_total;
                $this->credits = $user['credits'] ?? 0;

                if ($this->use_credits && $this->credits > 0) {
                    $this->credits_applied = min($this->credits, $this->sub_total);
                    $this->credits_remaining = $this->credits - $this->credits_applied;

                    $sub_total = $this->sub_total - $this->credits_applied;

                    if ($sub_total <= 0) {
                        // No hay fee y el total es 0
                        $this->processing_fee = 0;
                        $this->total = 0;
                        return;
                    }
                    $this->processing_fee = round(($sub_total * ($fee / 100)), 2);
                    $this->total = $sub_total + $this->processing_fee;
                } else {
                    $this->credits_applied = 0;
                    $this->credits_remaining = $this->credits;
                    $this->processing_fee = $cart->processing_fee;
                    $this->total = $cart->total;
                }
            } else {
                $this->sub_total = $cart->sub_total;
                $this->credits = 0;
                $this->processing_fee = $cart->processing_fee;
                $this->total = $cart->total;
            }
        }
    }

    #[On('update-step')]
    public function update_step($step): void {
        $this->current_step = $step;
    }

    #[On('process-cart')]
    public function process(): void {
        if ($this->use_credits) {
            return;
        }

        if ($this->total <= 0) {
            return;
        }

        $user = auth()->user();
        $amount = $this->total;

        Stripe::setApiKey(config('services.stripe.secret'));
        $intent = PaymentIntent::create([
            'amount' => (int) $amount * 100,
            'currency' => 'usd',
            'metadata' => [
                'order_id' => '123456789',
                'user_id' => $user['id']
            ]
        ]);

        $this->dispatch('open-stripe-modal', clientSecret: $intent->client_secret, orderId: '123456789');
    }

    public function render() {
        return view('livewire.order.checkout.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
