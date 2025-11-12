<?php

namespace App\Livewire\Customer;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    #[Url]
    public $item = 'user-data';

    #[On('user-logged-out')]
    public function user_logged_out(): void {
        $this->redirect(route('page', ['slug' => '/']), navigate: true);
    }

    public function render() {
        return view('livewire.customer.index')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
