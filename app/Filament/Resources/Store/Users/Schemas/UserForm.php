<?php

namespace App\Filament\Resources\Store\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('first_name')->label('Firstname')->required()->columnSpan(6),
                    TextInput::make('last_name')->label('Lastname')->required()->columnSpan(6),
                    TextInput::make('phone')->label('Phone')->required()->columnSpan(4),
                    TextInput::make('email')->label('Email')->unique('users', 'email', ignoreRecord: true)->required()->columnSpan(4),
                    TextInput::make('password')->password()->label('Password')
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn ($context) => $context === 'create')
                        ->columnSpan(4),
                    TextInput::make('credits')->label('Credits')->numeric()->default(0)->columnSpan(3),
                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpanFull()
            ]);
    }
}
