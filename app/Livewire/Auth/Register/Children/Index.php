<?php

namespace App\Livewire\Auth\Register\Children;

use Livewire\Component;

class Index extends Component {

    public array $students = [];

    protected $rules = [
        'students' => 'required|array|min:1'
    ];

    protected array $messages = [
        'students.min' => 'You must register at least one student.',
        'students.required' => 'You must register at least one student.',
    ];

    public function process() {
        $this->validate();
    }

    public function render() {
        return view('livewire.auth.register.children.index');
    }
}
