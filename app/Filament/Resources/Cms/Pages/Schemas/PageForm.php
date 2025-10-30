<?php

namespace App\Filament\Resources\Cms\Pages\Schemas;

use App\Classes\Blocks;
use App\Enums\Status;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    Group::make()->schema([
                        Section::make('Bloques')->schema([
                            Builder::make('content')->label('Bloques')->blockPickerColumns(4)->blocks(
                                (new Blocks('Page'))->init()
                            )->collapsible()->cloneable()->collapsed()
                        ]),
                        Section::make('SEO')->schema([
                            Group::make()->schema([
                                TextInput::make('title')->label('Título'),
                                TextInput::make('robots')->label('Robots')->default('follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large'),
                                Textarea::make('description')->label('Descripción'),
                                MediaPicker::make('media_id')->label('Imagen SEO')
                            ])->relationship('meta')
                        ])->collapsed()
                    ])->columnSpan(8),
                    Section::make('Ajustes')->schema([
                        TextInput::make('title')->label('Título')->columnSpanFull()->required(),
                        Select::make('status')->label('Estado')->options([
                            Status::PUBLISHED->value => Status::PUBLISHED->value,
                            Status::DRAFT->value => Status::DRAFT->value
                        ])->columnSpanFull()->required()->default(Status::PUBLISHED->value),
                        Toggle::make('is_home')->label('¿Página de inicio?')->columnSpanFull()->required(),
                    ])->columnSpan(4),
                ])->columnSpanFull()
            ]);
    }
}
