<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component {

    public $data;

    public $user_data = [
        'email' => '',
        'password' => ''
    ];

    protected $rules = [
        'user_data.email' => 'required|email',
        'user_data.password' => 'required|min:8'
    ];

    protected array $messages = [
        '*.*.required' => 'This field is required.',
        '*.required' => 'This field is required.',
        '*.*.email' => 'This field must be a valid email address.',
        '*.*.min' => 'This field must be at least :min characters.',
    ];

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function process() {
        $this->validate();
        if (auth()->attempt($this->user_data)) {
            $this->redirectIntended(route('customer.account'), navigate: true);
        } else {
            $this->toast('Invalid credentials.', 'Error!', 'error');
        }
    }

    public function render() {
        return view('livewire.auth.login');
    }
}
