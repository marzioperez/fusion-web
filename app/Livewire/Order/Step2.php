<?php

namespace App\Livewire\Order;

use Livewire\Component;

class Step2 extends Component {

    public $credits_to_apply = 0;
    public $subtotal_after_credits = 0;
    public $amount_to_charge = 0;
    public $sub_total = 23.56;
    public $total = 24.69;
    public $fee = 1.13;
    public int $user_credits = 0;
    public bool $use_credits = false;

    public function mount() {
        $user = auth()->user();
        $this->user_credits = $user['credits'] ?? 0;
    }

    public function render() {
        return view('livewire.order.step2');
    }
}
