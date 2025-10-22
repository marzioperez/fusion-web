<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component {

    public array $options;

    public function __construct(array $options = []) {
        $this->options = array_merge([
            'locale' => 'es',
            'enableTime' => false,
            'dateFormat' => 'Y-m-d',
            'altFormat' =>  'j F Y',
            'static' => false,
            'maxDate' => null, // 'today' o cualquier fecha en formato 'Y-m-d'
            'minDate' => null,
            'mode' => 'single', // 'single' o 'range'
            'altInput' => true,
            'allowInput' => false
        ], $options);
    }

    public function render(): View|Closure|string {
        return view('components.inputs.date');
    }
}
