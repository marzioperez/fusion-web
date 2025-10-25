<?php

namespace App\Filament\Resources\Store\Schools\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make('Datos del colegio')->schema([
                    TextInput::make('name')->label('Nombre del colegio')->columnSpanFull(),
                    TextInput::make('address')->label('Dirección')->columnSpan(8),
                    TextInput::make('phone')->label('Teléfono')->columnSpan(4),
                    TagsInput::make('emails')->label('Correos de contacto')->columnSpanFull(),

                ])->columnSpan(9)->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ]),
                Section::make('Logo')->schema([
                    MediaPicker::make('logo_media_id')->label('Logo del colegio'),
                    ColorPicker::make('color')->label('Color'),
                ])->columnSpan(3),
            ])->columns([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ]);
    }
}
