<?php

namespace App\Filament\Resources\Store\Students\Schemas;

use App\Models\Allergy;
use App\Models\Grade;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('first_name')->label('Nombre')->required()->columnSpan(6),
                    TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(6),
                    DatePicker::make('birth_of_date')->label('Fecha de nacimiento')->required()->columnSpan(4),
                    Select::make('school_id')->label('Colegio')->relationship('school', 'name')->required()->reactive()->columnSpan(4),
                    Select::make('grade_id')->label('Grado')->required()->options(function (callable $get) {
                        $school = $get('school_id');
                        if (!$school) {
                            return [];
                        }
                        return Grade::where('school_id', $school)->pluck('name', 'id')->toArray();
                    })->columnSpan(4),
                    Select::make('allergies')->label('Alergias')->options(Allergy::all()->pluck('name', 'id')->toArray())->multiple()->columnSpanFull(),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpanFull()
            ]);
    }
}
