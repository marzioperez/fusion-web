<?php

namespace App\Livewire\Auth\Register;

use App\Models\RequestRegister;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Form extends Component {

    #[Url]
    public $token;

    public $data = [
        'first_name' => '',
        'last_name' => '',
        'phone' => '',
        'email' => '',
        'password' => ''
    ];

    protected $rules = [
        'data.first_name' => 'required',
        'data.last_name' => 'required',
        'data.phone' => 'required|numeric',
        'data.email' => 'required|email|unique:users,email',
        'data.password' => 'required|min:8'
    ];

    protected array $messages = [
        '*.*.required' => 'This field is required.',
        '*.required' => 'This field is required.',
        '*.*.email' => 'This field must be a valid email address.',
        '*.*.unique' => 'This email address is already registered.',
        '*.*.min' => 'This field must be at least :min characters.',
        '*.*.numeric' => 'This field must be a number.',
    ];

    public function mount() {
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            if ($request_register) {
                $this->data = array_merge($this->data, $request_register['data']);
            }
        }
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function process() {
        $this->validate();
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            if ($request_register) {
                $request_register->update([
                    'data' => array_merge($request_register['data'], $this->data),
                    'step' => 2
                ]);
            }
        } else {
            $data['token'] = Str::uuid();
            $data['data'] = $this->data;
            $data['step'] = 2;
            RequestRegister::create($data);
            $this->dispatch('set-token-url', token: $data['token']);
        }
        $this->dispatch('update-step', step: 2);
    }

    public function render() {
        return view('livewire.auth.register.form');
    }
}
