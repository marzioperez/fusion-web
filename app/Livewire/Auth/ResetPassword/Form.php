<?php

namespace App\Livewire\Auth\ResetPassword;

use App\Mail\Auth\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Form extends Component {

    public $email = '';

    protected $messages = [
        '*.required' => 'This field is required.',
        'email.regex' => 'This field must be a valid email address.'
    ];

    public function process() {
        $rules = [
            'email' => ['required', 'string', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/']
        ];

        $this->validate($rules);
        $user = User::where('email', $this->email)->first();
        if ($user) {
            $token = md5(uniqid(rand(), true));
            $user->update([
                'reset_password_code' => fake()->randomNumber(6),
                'reset_password_token' => $token
            ]);
            Mail::to($this->email)->send(new ResetPassword($user));
            $this->redirect(route('page', ['slug' => 'update-password']) . '?token=' . $token , navigate: true);
        } else {
            $this->toast('Invalid email.', 'Error!', 'error');
        }
    }

    public function render() {
        return view('livewire.auth.reset-password.form');
    }
}
