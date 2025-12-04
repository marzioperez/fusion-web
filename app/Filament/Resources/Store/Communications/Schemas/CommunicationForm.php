<?php

namespace App\Filament\Resources\Store\Communications\Schemas;

use App\Filament\Forms\Components\MediaGallery;
use App\Models\School;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommunicationForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('subject')->label('Subject')->required()->columnSpanFull(),
                    Toggle::make('send_all')->label('Send to all schools')->default(true)->live()->required()->columnSpanFull(),
                    Select::make('school_ids')->label('Schools')
                        ->options(School::all()->pluck('name', 'id')->toArray())
                        ->visible(fn($get) => $get('send_all') == false)
                        ->required()->multiple()->reactive()->columnSpanFull(),
                    RichEditor::make('message')->label('Message')->columnSpanFull(),

                ])->columns([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->columnSpan(8)
            ]);
    }
}
