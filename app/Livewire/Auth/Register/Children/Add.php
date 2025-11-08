<?php

namespace App\Livewire\Auth\Register\Children;

use App\Models\School;
use Livewire\Component;

class Add extends Component {

    public $data = [
        'first_name' => '',
        'last_name' => '',
        'school_id' => '',
        'grade_id' => '',
        'allergies' => '',
        'birth_of_date' => '',
        'avatar_media_id' => ''
    ];

    protected $rules = [
        'data.first_name' => 'required',
        'data.last_name' => 'required',
        'data.school_id' => 'required',
        'data.grade_id' => 'required',
        'data.birth_of_date' => 'required|date'
    ];

    protected array $messages = [
        '*.*.required' => 'This field is required.',
        '*.required' => 'This field is required.',
        '*.*.email' => 'This field must be a valid email address.',
        '*.*.unique' => 'This email address is already registered.',
        '*.*.min' => 'This field must be at least :min characters.',
        '*.*.numeric' => 'This field must be a number.',
    ];

    public array $schools, $grades, $avatars;

    public function mount() {
        $this->schools = School::query()->select(['id', 'name'])->orderBy('name')->get()->toArray();
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function process() {
        $this->validate();
    }

    public function render() {
        return view('livewire.auth.register.children.add');
    }
}
