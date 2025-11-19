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
    public int $userCredits = 0;
    public int $useCredits = 0;

    public function updatedUseCredits() {
        $this->recalculate();
    }

    protected function recalculate(): void {
        $this->credits_to_apply = 0;

        if ($this->useCredits && $this->userCredits > 0) {
            $this->credits_to_apply = min($this->userCredits, $this->total);
        }

        $this->subtotal_after_credits = $this->total - $this->credits_to_apply;

        if ($this->subtotal_after_credits <= 0) {
            $this->fee = 0;
            $this->amount_to_charge = 0;
        } else {
            // 4.8% fee, redondeado hacia arriba
            $this->fee = (int) ceil($this->subtotal_after_credits * 0.048);
            $this->amount_to_charge = $this->subtotal_after_credits + $this->fee;
        }
    }

    public function render() {
        return view('livewire.order.step2');
    }
}
