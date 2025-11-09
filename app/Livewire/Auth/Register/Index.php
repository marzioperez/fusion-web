<?php

namespace App\Livewire\Auth\Register;

use App\Enums\Status;
use App\Models\RequestRegister;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

    #[On('set-token-url')]
    public function setTokenUrl($token): void {
        $this->token = $token;
    }

    #[On('finished')]
    public function finished(): void {
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            $exists = User::where('email', $request_register['data']['email'])->first();
            if ($exists) {
                $this->toast('El correo electrónico ingresado ya existe. Intente con otro.', 'Error', 'error');
            } else {
                if (empty($request_register['students'])) {
                    $this->toast('Debes agregar al menos un alumno.', 'Error', 'error');
                } else {

                    $data = $request_register['data'];
                    $user = User::create($data);
                    foreach ($request_register['students'] as $student) {
                        $user->students()->create($student);
                    }
                    $request_register->update([
                        'status' => Status::FINISHED->value,
                        'step' => 3
                    ]);
                    // Mail::to($user->email)->send(new \App\Mail\Register\Finished($user, $data['password']));
                    $this->step = 3;
                }
            }
        }
    }

    public function render() {
        return view('livewire.auth.register.index');
    }
}
