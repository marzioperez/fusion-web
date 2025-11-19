<?php

namespace App\Livewire\Order\Checkout;

use App\Actions\Cart\RemoveItem;
use App\Actions\Cart\UpdateItem;
use App\Settings\GeneralSettings;
use Livewire\Component;

class Item extends Component {

    public $item;
    public $index;
    public $token;

    public function remove(): void {
        RemoveItem::run($this->token, $this->index);
        $this->dispatch('cart-updated');
    }

    public function plus(): void {
        $settings = new GeneralSettings();
        $limit = $settings->limit_product_per_student;
        $quantity = $this->item['quantity'] + 1;
        if ($quantity > $limit) {
            $this->toast('Max quantity exceeded', 'Error', 'error');
        } else {
            $this->item['quantity'] = $quantity;
            UpdateItem::run($this->token, $this->index, $quantity);
            $this->dispatch('cart-updated');
        }
    }

    public function minus(): void {
        if ($this->item['quantity'] > 1) {
            $quantity = $this->item['quantity'] - 1;
            $this->item['quantity'] = $quantity;
            UpdateItem::run($this->token, $this->index, $quantity);
            $this->dispatch('cart-updated');
        }
    }

    public function render() {
        return view('livewire.order.checkout.item');
    }
}
