<?php

namespace App\Livewire\Product;

use Livewire\Component;

class Item extends Component {

    public $product, $student;

    public function mount() {

    }

    public function render() {
        return view('livewire.product.item');
    }
}
