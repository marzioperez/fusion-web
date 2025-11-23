<?php

namespace App\Filament\Resources\Store\MenuEntries\Schemas;

use App\Models\Grade;
use App\Models\Product;
use App\Models\School;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class MenuEntryForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    Select::make('school_id')->label('School')->options(School::all()->pluck('name', 'id'))->searchable()->preload()->required()->reactive()->columnSpan(4),
                    Select::make('grade_id')->label('Grade')->options(function (Get $get){
                        return Grade::where('school_id', $get('school_id'))->pluck('name', 'id')->toArray();
                    })->required()->reactive()->columnSpan(4),
                    DatePicker::make('date')->label('Date')->required()->columnSpan(4),
                    Select::make('product_id')->label('Product')->options(Product::all()->pluck('name', 'id'))->reactive()->searchable()->preload()->required()
                        ->afterStateUpdated(function ($state, Set $set) {
                            if ($state) {
                                $product = Product::find($state);
                                if ($product){
                                    $set('price', $product->price);
                                }
                            }
                        })
                        ->columnSpan(4),
                    TextInput::make('price')->prefix('$')->label('Price')->numeric()->default(0)->required()->columnSpan(4),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpanFull(),
            ]);
    }
}
