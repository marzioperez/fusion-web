<?php

namespace App\Filament\Resources\Store\Products\Schemas;

use App\Enums\ProductTypes;
use App\Enums\Status;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')->label('Nombre')->required()->columnSpan(8),
                    Select::make('type')->label('Tipo de producto')->options([
                        ProductTypes::FOOD->value => ProductTypes::FOOD->value,
                        ProductTypes::SIMPLE->value => ProductTypes::SIMPLE->value,
                    ])->required()->reactive()->columnSpan(4),
                    Select::make('status')->label('Estado')->options([
                        Status::PUBLISHED->value => Status::PUBLISHED->value,
                        Status::DRAFT->value => Status::DRAFT->value
                    ])->columnSpan(4),
                    TextInput::make('price')->label('Precio')->numeric()->required()->columnSpan(4),
                    TextInput::make('offer_price')->label('Precio de oferta')->numeric()->required()->columnSpan(4),
                    RichEditor::make('description')->label('Descripción')->columnSpanFull(),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpan(8),
                Section::make()->schema([
                    MediaPicker::make('media_id')->label('Foto'),
                ])->columnSpan(4)
            ])->columns([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ]);
    }
}
