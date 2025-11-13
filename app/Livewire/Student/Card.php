<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Card extends Component {

    public $student;

    public function mount() {
        $this->student = $this->parseStudent($this->student);
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
            'grade_id'
        ]);

        return array_merge($student, [
            'avatar' => $avatar,
            'school_name' => $school['name'],
            'grade_name' => $grade['name'],
        ]);
    }

    public function render() {
        return view('livewire.student.card');
    }
}
