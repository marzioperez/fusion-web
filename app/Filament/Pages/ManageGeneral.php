<?php

namespace App\Filament\Pages;

use App\Filament\Forms\Components\MediaPicker;
use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageGeneral extends SettingsPage {
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static string $settings = GeneralSettings::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Ajustes';
    protected static ?string $title = 'Ajustes generales';
    protected static ?int $navigationSort = 51;

    public function form(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make('Logos')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        MediaPicker::make('logo')->columnSpan(4),
                        MediaPicker::make('logo_mail')->columnSpan(4),
                        MediaPicker::make('favicon')->columnSpan(4),
                    ])
                ])->collapsible()->columnSpanFull(),
                Section::make('Redes sociales')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('instagram')->label('Instagram')->columnSpan(4),
                        TextInput::make('youtube')->label('Youtube')->columnSpan(4),
                        TextInput::make('linkedin')->label('Linkedin')->columnSpan(4),
                        TextInput::make('tiktok')->label('Tiktok')->columnSpan(4),
                        TextInput::make('facebook')->label('Facebook')->columnSpan(4),
                        TextInput::make('twitter_x')->label('Twitter X')->columnSpan(4),
                        TextInput::make('whatsapp')->label('WhatsApp')->columnSpanFull()
                    ])
                ])->collapsible()->columnSpanFull(),
                Section::make('Datos de la empresa')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('email')->label('Email')->columnSpan(6),
                        TextInput::make('phone')->label('Teléfono')->columnSpan(6),
                        TextInput::make('address')->label('Dirección')->columnSpanFull(),
                    ])
                ])->collapsible()->columnSpanFull(),

                Section::make('Avatares')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        Repeater::make('avatars')->label('Avatares')->schema([
                            MediaPicker::make('avatar')->label('Avatar'),
                        ])->grid(3)->columnSpanFull()
                    ])
                ])->collapsible()->columnSpanFull(),

                Section::make('Parámetros de tienda')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TagsInput::make('units')->label('Unidades de medida')->columnSpanFull(),
                    ])
                ])->collapsible()->columnSpanFull(),
            ]);
    }
}
