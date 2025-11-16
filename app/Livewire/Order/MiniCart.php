<?php

namespace App\Livewire\Order;

use App\Actions\Cart\RemoveItem;
use App\Enums\Status;
use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniCart extends Component {

    public $cart_count = 0;
    public array $items = [];
    public $token;

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
            }
        }
    }

    public function removeItem($id) {
        RemoveItem::run($this->token, $id);
        $this->load_cart();
    }

    public function render() {
        return view('livewire.order.mini-cart');
    }
}
