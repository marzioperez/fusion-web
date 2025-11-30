<?php

namespace App\Livewire\Customer\Orders;

use App\Enums\Status;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {

    use WithPagination;

    public function render() {
        $orders = Order::where('user_id', auth()->id())
            ->whereIn('status', [Status::FINISHED->value, Status::ERROR->value])
            ->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.customer.orders.index', compact('orders'));
    }
}
