<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Attributes\Url;
use Livewire\Component;

class Step3 extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    #[Url]
    public $order;

    public Order $model;

    public function mount() {
        if ($this->order) {
            $order = Order::where('code', $this->order)->first();
            if ($order) {
                $user = auth()->user();
                if ($user['id'] === $order->user_id) {
                    $this->model = $order;
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function render() {
        return view('livewire.order.step3')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
