<?php

namespace App\Livewire\Auth\ResetPassword;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class ValidateCode extends Component {

    #[Url]
    public $token;

    public $email;
    public User $user;

    public $user_data = [
        'code' => '',
        'password' => ''
    ];

    protected $rules = [
        'user_data.code' => 'required',
        'user_data.password' => 'required|min:8'
    ];

    protected array $messages = [
        '*.*.required' => 'This field is required.',
        '*.required' => 'This field is required.',
        '*.*.min' => 'This field must be at least :min characters.',
    ];

    public function mount() {
        $user = User::where('reset_password_token', $this->token)->first();
        if ($user) {
            $this->email = $user->email;
            $this->user = $user;
        } else {
            $this->redirect(route('page', ['slug' => 'login']));
        }
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function process(): void {
        $this->validate();

        if ($this->user_data['code'] === $this->user['reset_password_code']) {
            $this->user->update([
                'password' => $this->user_data['password'],
                'reset_password_code' => null,
                'reset_password_token' => null
            ]);
            auth()->attempt([
                'email' => $this->user['email'],
                'password' => $this->user_data['password']
            ]);
            $this->redirect(route('customer.account'));
        } else {
            $this->toast('Invalid code.', 'Error!', 'error');
        }
    }

    public function render() {
        return view('livewire.auth.reset-password.validate-code');
    }
}
