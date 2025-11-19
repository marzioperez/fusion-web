<?php

namespace App\Livewire\Order;

use App\Actions\Cart\RemoveItem;
use App\Enums\Status;
use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class Step1 extends Component {

    public $cart_count = 0;
    public array $items = [];
    public $token;

    public $sub_total = 0, $total = 0, $processing_fee = 0;

    public function mount() {
        $this->load_cart();
    }

    #[On('cart-updated')]
    public function load_cart():void {
        $token = session()->get('cart-token');
        if ($token) {
            $this->token = $token;
            $cart = Cart::where('token', $token)->where('status', Status::PENDING->value)->get()->last();
            if ($cart) {
                $this->cart_count = $cart->total_items;
                $this->items = $cart->items;
                $this->sub_total = $cart->sub_total;
                $this->total = $cart->total;
                $this->processing_fee = $cart->processing_fee;
            }
        }
    }

    public function removeItem($id) {
        RemoveItem::run($this->token, $id);
        $this->load_cart();
    }

    public function goToStep2() {
        $this->dispatch('next-step', step: 2);
    }

    public function render() {
        return view('livewire.order.step1');
    }
}
