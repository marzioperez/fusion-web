<?php

namespace App\Livewire\Order;

use Livewire\Attributes\On;
use Livewire\Component;

class Checkout extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public $current_step = 1;

    #[On('next-step')]
    public function next_step($step) {
        $this->current_step = $step;
    }

    public function render() {
        return view('livewire.order.checkout')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
