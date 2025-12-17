<?php

namespace App\Livewire\Customer\Students;

use App\Models\Allergy;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Settings\GeneralSettings;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component {

    public $data = [
        'first_name' => '',
        'last_name' => '',
        'school_id' => '',
        'grade_id' => '',
        'teacher_id' => null,
        'allergies' => [],
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

    public array $schools, $grades, $avatars, $allergies;
    public array $teachers = [];
    public bool $prefilling = false;

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
        $this->allergies = Allergy::all()->toArray();
    }

    public function updated($property): void {
        $this->validateOnly($property);
    }

    #[On('student-edited')]
    public function onStudentEdited($student): void {
        $this->prefilling = true;
        $this->grades = Grade::where('school_id', $student['school_id'])->get()->toArray();
        $this->teachers = Teacher::where('grade_id', $student['grade_id'])->get()->toArray();
        $this->data = $student;
        $this->prefilling = false;
        $this->dispatch('open-modal', name: 'modal-edit-student');
    }

    public function updatedDataSchoolId($value):void {
        $this->grades = Grade::where('school_id', $value)->get()->toArray();
        $this->data['grade_id'] = '';
    }

    public function updatedDataGradeId($value):void {
        $this->teachers = Teacher::where('grade_id', $value)->get()->toArray();
        $this->data['teacher_id'] = null;
    }

    public function process() {
        $this->validate();
        $student = Student::find($this->data['id']);
        $student->update($this->data);

        $this->reset('data');
        $this->resetValidation();
        $this->dispatch('close-modal');
        $this->dispatch('refresh-students');
    }

    public function render() {
        return view('livewire.customer.students.edit');
    }
}
