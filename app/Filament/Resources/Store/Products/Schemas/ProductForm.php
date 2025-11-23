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
                    TextInput::make('sku')->label('SKU')->required()->columnSpan(3),
                    TextInput::make('name')->label('Name')->required()->columnSpan(5),
                    Select::make('type')->label('Type')->options([
                        ProductTypes::FOOD->value => ProductTypes::FOOD->value,
                        ProductTypes::SIMPLE->value => ProductTypes::SIMPLE->value,
                    ])->required()->reactive()->columnSpan(4),
                    Select::make('status')->label('Status')->options([
                        Status::PUBLISHED->value => Status::PUBLISHED->value,
                        Status::DRAFT->value => Status::DRAFT->value
                    ])->columnSpan(4),
                    TextInput::make('price')->label('Price')->numeric()->required()->columnSpan(4),
                    TextInput::make('offer_price')->label('Offer price')->numeric()->columnSpan(4),
                    RichEditor::make('description')->label('Description')->columnSpanFull(),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpan(8),
                Section::make()->schema([
                    MediaPicker::make('media_id')->label('Photo'),
                ])->columnSpan(4)
            ])->columns([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ]);
    }
}
