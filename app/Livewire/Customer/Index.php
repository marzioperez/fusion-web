<?php

namespace App\Livewire\Customer;

use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    #[Url]
    public $item = 'user-data';

    public function render() {
        return view('livewire.customer.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
