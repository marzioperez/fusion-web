<?php

namespace App\Livewire\Auth\Register\Children;

use App\Models\Grade;
use App\Models\School;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $general_settings = new GeneralSettings();
        foreach ($general_settings->avatars as $avatar) {
            $media = Media::find($avatar['avatar']);
            if ($media) {
                $this->avatars[] = [
                    'id' => $avatar['avatar'],
                    'url' => ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl()),
                ];
            }
        }
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    public function updatedDataSchoolId($value):void {
        $this->grades = Grade::where('school_id', $value)->get()->toArray();
        $this->data['grade_id'] = '';
    }

    public function process() {
        $this->validate();
        $data = $this->data;
        $school = School::find($data['school_id']);
        $grade = Grade::find($data['grade_id']);
        $data['school_name'] = $school->name;
        $data['grade_name'] = $grade->name;

        $this->dispatch('student-added', data: $data);
        $this->reset('data');
        $this->resetValidation();
        $this->dispatch('close-modal');
    }

    public function render() {
        return view('livewire.auth.register.children.add');
    }
}
