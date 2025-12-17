<?php

namespace App\Filament\Resources\Store\Students\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use App\Models\Allergy;
use App\Models\Grade;
use App\Models\Teacher;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class StudentForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Tabs::make('Foto/Avatar')->tabs([
//                    Tabs\Tab::make('Subir foto')->schema([
//                        SpatieMediaLibraryFileUpload::make('photo')->label('Foto')->preserveFilenames()->collection('photo')->afterStateUpdated(function ($state, callable $set, $context, $record) {
//                            if ($record) {
//                                $record->clearProfileImageCache();
//                            }
//                        }),
//                    ]),
                    Tabs\Tab::make('Seleccionar avatar')->schema([
                        MediaPicker::make('avatar_media_id')->label('Avatar'),
                    ]),
                ])->columnSpan(4),
                Section::make()->schema([
                    TextInput::make('first_name')->label('Nombre')->required()->columnSpan(6),
                    TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(6),
                    DatePicker::make('birth_of_date')->label('Fecha de nacimiento')->required()->columnSpan(4),
                    Select::make('school_id')->label('Colegio')->relationship('school', 'name')->required()->reactive()->columnSpan(4),
                    Select::make('grade_id')->label('Grado')->reactive()->required()->options(function (callable $get) {
                        $school = $get('school_id');
                        if (!$school) {
                            return [];
                        }
                        return Grade::where('school_id', $school)->pluck('name', 'id')->toArray();
                    })->columnSpan(4),
                    Select::make('teacher_id')->label('Teacher')->options(function (callable $get) {
                        $grade = $get('grade_id');
                        if (!$grade) {
                            return [];
                        }
                        return Teacher::where('grade_id', $grade)->pluck('name', 'id')->toArray();
                    })->columnSpanFull(),
                    TagsInput::make('allergies')->label('Alergias')->suggestions(Allergy::all()->pluck('name')->toArray())->columnSpanFull(),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpan(8)
            ])->columns([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ]);
    }
}
