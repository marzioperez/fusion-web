<?php

namespace App\Livewire\Auth\Register\Children;

use App\Models\RequestRegister;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component {

    public array $students = [];
    public RequestRegister $request_register;

    protected $rules = [
        'students' => 'required|array|min:1'
    ];

    #[Url]
    public $token;

    protected array $messages = [
        'students.min' => 'You must register at least one student.',
        'students.required' => 'You must register at least one student.',
    ];

    public function mount() {
        $this->students = [];
        if ($this->token) {
            $request_register = RequestRegister::where('token', $this->token)->first();
            if ($request_register) {
                $loaded = $request_register['students'] ?? [];
                $this->students = is_array($loaded) ? $loaded : [];
                $this->request_register = $request_register;
            }
        }
    }

    public function process() {
        $this->validate();
    }

    #[On('set-token-url')]
    public function setTokenUrl($token): void {
        $this->token = $token;
        $request_register = RequestRegister::where('token', $this->token)->first();
        if ($request_register) {
            $loaded = $request_register['students'] ?? [];
            $this->students = is_array($loaded) ? $loaded : [];
            $this->request_register = $request_register;
        }
    }

    #[On('student-added')]
    public function onStudentAdded(array $data): void {
        $existing = $this->request_register?->students ?? [];
        $existing[] = $data;
        $this->students = $existing;
        $this->request_register->update([
            'students' => $this->students,
        ]);
        $this->validateOnly('students');
    }

    #[On('student-updated')]
    public function onStudentUpdated(array $data, int $index): void {
        // Si el índice no existe, salimos silenciosamente (o podrías lanzar validación)
        if (!isset($this->students[$index])) {
            return;
        }

        // Merge conservador: prioriza lo nuevo pero mantiene campos anteriores no enviados
        $current = $this->students[$index];
        $merged  = array_merge($current, $data);

        // Actualiza la lista en memoria
        $this->students[$index] = $merged;

        // Persiste en BD (RequestRegister) si está disponible
        if (isset($this->request_register)) {
            $this->request_register->update([
                'students' => $this->students
            ]);
        }
        $this->validateOnly('students');
        $this->toast('Student updated.', 'Success!', 'success');
    }

    public function removeStudent(int $index): void {
        if (isset($this->students[$index])) {
            unset($this->students[$index]);
            $this->students = array_values($this->students);

            $this->request_register->update([
                'students' => $this->students,
            ]);
        }
        $this->validateOnly('students');
    }

    public function editStudent(int $index): void {
        if (isset($this->students[$index])) {
            $this->dispatch('student-edited', student: $this->students[$index], index: $index);
        }
    }

    public function render() {
        return view('livewire.auth.register.children.index');
    }
}
