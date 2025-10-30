<?php

namespace App\Filament\Resources\Cms\Sliders\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SliderForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')->label('Nombre')->required(),
                    Textarea::make('description')->label('Descripción')
                ])->columnSpanFull()
            ]);
    }
}
