<?php

namespace App\Classes;

use App\Filament\Forms\Components\MediaPicker;
use App\Models\Slider;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class Blocks {

    public string $model;

    public function __construct(string $model) {
        $this->model = $model;
    }

    public function padding_settings(array $default_values = [
        'top_desktop' => 7,
        'bottom_desktop' => 7,
        'top_mobile' => 6,
        'bottom_mobile' => 6,
    ]): array {
        return [
            Grid::make([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ])->schema([
                Section::make('Visualización')->schema([
                    Toggle::make('visible')->label('Mostrar')->default(true)->columnSpanFull(),
                    ColorPicker::make('bg_color')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull(),
                    TextInput::make('id')->label('Identificador')->columnSpanFull(),
                ])->columnSpanFull(),
                Section::make('Espaciado interno Desktop')->schema([
                Select::make('padding_top_desktop')->label('Arriba')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['top_desktop'])->native(false)->searchable(),
                Select::make('padding_bottom_desktop')->label('Abajo')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['bottom_desktop'])->native(false)->searchable(),
            ])->columns()->columnSpan(6),
                Section::make('Espaciado interno Mobile')->schema([
                Select::make('padding_top_mobile')->label('Arriba')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['top_mobile'])->native(false)->searchable(),
                Select::make('padding_bottom_mobile')->label('Abajo')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['bottom_mobile'])->native(false)->searchable()
            ])->columns()->columnSpan(6)
            ])->columnSpanFull()
        ];
    }

    public function init(): array {
        $elements = collect([
            Block::make('slider')->label('Slider')->schema([
                Select::make('slider')->label('Slider')->options(Slider::all()->pluck('name', 'id'))->columnSpanFull(),
                Toggle::make('arrows')->label('Mostrar flechas')->default(false)->columnSpanFull(),
                Toggle::make('pagination')->label('Mostrar paginación')->default(false)->columnSpanFull(),
            ]),
        ]);

        return $elements->sortBy(fn($block) => $block->getLabel())->values()->all();
    }
}
