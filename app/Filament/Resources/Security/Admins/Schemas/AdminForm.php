<?php

namespace App\Filament\Resources\Security\Admins\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class AdminForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')->label('Nombre y Apellidos')->required()->columnSpanFull(),
                    TextInput::make('email')->label('Email')
                        ->unique('admins', 'email', ignoreRecord: true)
                        ->required()->columnSpan(6),
                    TextInput::make('password')->password()->label('Contraseña')
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn ($context) => $context === 'create')
                        ->columnSpan(6),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpanFull()
            ]);
    }
}
