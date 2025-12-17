<?php

namespace App\Livewire\Customer\Students;

use App\Models\Student;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Index extends Component
{

    public Collection $students;
    public $delete_student_id;

    public function mount() {
        $this->loadStudents();
    }

    #[On('refresh-students')]
    public function loadStudents(): void {
        $this->students = collect();
        $model = Student::query();
        $model->where('user_id', auth()->user()->id)->orderBy('first_name')->get()->each(function($student) {
            return $this->students->push($this->parseStudent($student));
        });
    }

    public function parseStudent(Student $student) {
        $avatar = null;

        if ($student['avatar_media_id']) {
            $media = Media::find($student['avatar_media_id']);
            $avatar = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
        }

        if ($student->hasMedia('photo')) {
            $media = $student->getFirstMedia('photo');
            $avatar = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
        }

        $school = $student->school;
        $grade = $student->grade;

        $student = $student->only([
            'id',
            'first_name',
            'last_name',
            'school_id',
            'birth_of_date',
            'avatar_media_id',
            'allergies',
            'grade_id',
            'teacher_id'
        ]);

        return array_merge($student, [
            'avatar' => $avatar,
            'school_name' => $school['name'],
            'grade_name' => $grade['name'],
        ]);
    }

    public function deleteStudent(): void {
        $student = Student::find($this->delete_student_id);
        if ($student) {
            $student->delete();
        }
        $this->loadStudents();
        $this->dispatch('close-modal');
    }

    public function editStudent($id): void {
        $student = $this->students->where('id', $id)->first();
        $this->dispatch('student-edited', student: $student);
    }

    public function render() {
        return view('livewire.customer.students.index');
    }
}
