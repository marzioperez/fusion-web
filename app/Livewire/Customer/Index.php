<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public function render() {
        return view('livewire.customer.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
