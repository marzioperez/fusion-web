<?php

namespace App\Livewire\Auth\Register;

use App\Models\RequestRegister;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component {

    public $step = 1;

    #[Url]
    public $token;

    public function mount() {
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            $this->step = $request_register['step'] ?? 1;
        }
    }

    #[On('update-step')]
    public function update_step($step): void {
        $this->step = $step;
    }

    #[On('finished')]
    public function finished(): void {
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            $exists = User::where('email', $request_register['data']['email'])->first();
            if ($exists) {
                $this->toast('El correo electrónico ingresado ya existe. Intente con otro.', 'Error', 'error');
            } else {
                $token = Str::uuid();
                $data = $request_register['data'];
                $user = User::create($data);


                // Mail::to($user->email)->send(new \App\Mail\Register\Finished($user, $data['password']));

                $this->redirect($this->data['finished_url'] . '?token=' . $token, navigate: true);
            }
        }
    }

    public function render() {
        return view('livewire.auth.register.index');
    }
}
