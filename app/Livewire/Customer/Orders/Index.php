<?php

namespace App\Livewire\Customer\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {

    use WithPagination;

    public function render() {
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.customer.orders.index', compact('orders'));
    }
}
