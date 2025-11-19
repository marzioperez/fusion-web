<?php

namespace App\Livewire\Order\Checkout;

use App\Enums\Status;
use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public Cart $cart;
    public $token;
    public $sub_total = 0, $total = 0, $processing_fee = 0;

    public $current_step = 1;

    public function mount() {
        $token = session()->get('cart-token');
        if ($token) {
            $this->token = $token;
            $this->load_cart();
        }
    }

    #[On('cart-updated')]
    public function load_cart():void {
        $cart = Cart::where('token', $this->token)->where('status', Status::PENDING->value)->get()->last();
        if ($cart) {
            $this->sub_total = $cart->sub_total;
            $this->total = $cart->total;
            $this->processing_fee = $cart->processing_fee;
        }
    }

    #[On('next-step')]
    public function next_step($step) {
        $this->current_step = $step;
    }

    public function render() {
        return view('livewire.order.checkout.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
