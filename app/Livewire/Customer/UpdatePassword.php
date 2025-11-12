<?php

namespace App\Livewire\Customer;

use App\Models\User;
use Livewire\Component;

class UpdatePassword extends Component {

    public User $user;

    public $data = [
        'password' => '',
        'confirm_password' => ''
    ];

    protected $messages = [
        '*.*.required' => 'This field is required.',
        '*.*.confirm' => 'The password fields not same.',
        '*.*.same' => 'The password fields not same.',
        '*.*.min' => 'This field must be at least :min characters.',
    ];

    protected $rules = [
        'data.password' => 'required|min:8',
        'data.confirm_password' => 'required|same:data.password'
    ];

    public function mount() {
        $this->user = auth()->user();
    }

    public function process() {
        $this->validate();
        $this->user->update($this->data);
        $this->toast('Your password has been updated!', 'Success!', 'success');
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function render() {
        return view('livewire.customer.update-password');
    }
}
