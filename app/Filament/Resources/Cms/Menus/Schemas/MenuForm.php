<?php

namespace App\Filament\Resources\Cms\Menus\Schemas;

use App\Enums\Positions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('name')->label('Nombre')->required()->columnSpan(6),
                        Select::make('position')->label('Ubicación')->options([
                            Positions::HEADER->value => Positions::HEADER->value,
                            Positions::FOOTER_2->value => Positions::FOOTER_2->value,
                        ])->required()->columnSpan(6),
                    ])
                ])->columnSpanFull()
            ]);
    }
}
