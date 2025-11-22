<?php

namespace App\Livewire\Customer\Orders;

use App\Models\Order;
use Livewire\Attributes\Url;
use Livewire\Component;

class Detail extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public Order $order;

    #[Url]
    public $item = null;

    #[Url]
    public $code;

    public function mount() {
        if ($this->code) {
            $order = Order::where('code', $this->code)->where('user_id', auth()->user()->id)->first();
            if ($order) {
                $this->order = $order;
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function render() {
        return view('livewire.customer.orders.detail')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
