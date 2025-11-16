<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Checkout extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public function render() {
        return view('livewire.order.checkout')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
