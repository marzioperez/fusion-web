<?php

namespace App\Livewire\Customer;

use App\Models\User;
use Livewire\Component;

class UserData extends Component {

    public $data = [
        'first_name',
        'last_name',
        'phone',
        'email'
    ];

    protected array $messages = [
        '*.*.required' => 'This field is required.',
        '*.required' => 'This field is required.',
        '*.*.email' => 'This field must be a valid email address.',
        '*.*.unique' => 'This email address is already registered.',
        '*.*.min' => 'This field must be at least :min characters.',
        '*.*.numeric' => 'This field must be a number.',
    ];

    public User $user;

    public function mount() {
        $this->user = auth()->user();
        $this->data = $this->user->toArray();
    }

    public function process() {
        $rules = [
            'data.first_name' => 'required',
            'data.last_name' => 'required',
            'data.phone' => 'required|numeric',
            'data.email' => 'required|email|unique:users,email,' . $this->user['id'] . ',id'
        ];
        $this->validate($rules);
        $this->user->update($this->data);
        $this->toast('Your data has been updated!', 'Success!', 'success');
    }

    public function render() {
        return view('livewire.customer.user-data');
    }
}
