<?php

namespace App\Livewire\Product;

use App\Actions\Cart\AddToCart;
use Illuminate\Support\Str;
use Livewire\Component;

class Item extends Component {

    public $product, $student;

    public function mount() {

    }

    public function add_to_cart(): void{
        // 1. Resolver token
        $token = session()->get('cart-token');

        if (!$token) {
            $token = (string) Str::uuid();
            session()->put('cart-token', $token);
        }

        $item = $this->product;
        $item['student'] = $this->student;
        $add_to_cart = AddToCart::run($token, $item);
        if ($add_to_cart['status'] === 'success') {
            $this->dispatch('cart-updated');
            $this->toast('Product added successfully.', 'Success!', 'success');
        } else {
            $this->toast('This item is already in your cart.', 'Error!', 'error');
        }
    }

    public function render() {
        return view('livewire.product.item');
    }
}
