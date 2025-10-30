<?php

namespace App\Filament\Resources\Cms\Sliders\RelationManagers;

use App\Enums\SlideTypes;
use App\Filament\Forms\Components\MediaPicker;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlidesRelationManager extends RelationManager {

    protected static string $relationship = 'slides';

    public function form(Schema $schema): Schema {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    TextInput::make('title')->label('Título')->required()->columnSpan(8),
                    Select::make('type')->label('Tipo')->options([
                        SlideTypes::IMAGE->value => SlideTypes::IMAGE->value,
                        SlideTypes::BG_IMAGE_AND_TEXT->value => SlideTypes::BG_IMAGE_AND_TEXT->value,
                    ])->live()->columnSpan(4),
                    Toggle::make('show')->label('Mostrar')->default(true)->columnSpan(4),

                    Section::make('Imagen de fondo y contenido')->schema([
                        \Filament\Forms\Components\Builder::make('content')->label('Párrafo')->blocks([
                            Block::make(SlideTypes::PARAGRAPH->value)->schema([
                                Grid::make([
                                    'default' => 1,
                                    'sm' => 3,
                                    'xl' => 12,
                                    '2xl' => 12
                                ])->schema([
                                    RichEditor::make('text')->label('Contenido')->required()->columnSpanFull(),
                                ])
                            ]),
                            Block::make(SlideTypes::BUTTON->value)->label('Botón')->schema([
                                TextInput::make('text')->label('Texto')->required(),
                                TextInput::make('url')->label('URL')->required(),
                            ])->columns(),
                            Block::make(SlideTypes::BOTTOM_BOX->value)->label('Contenido en pie de banner')->schema([
                                TextInput::make('title')->label('Título')->required(),
                                RichEditor::make('content')->label('Contenido')->required(),
                            ]),
                        ]),
                    ])->hidden(fn(Get $get) => $get('type') !== SlideTypes::BG_IMAGE_AND_TEXT->value)->columnSpanFull(),

                    Section::make('Imagen')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            MediaPicker::make('image_desktop_id')->label('Imagen desktop')->columnSpan(6),
                            MediaPicker::make('image_mobile_id')->label('Imagen móbil')->columnSpan(6),
                            TextInput::make('url')->label('URL')->visible(fn(Get $get) => $get('type') === SlideTypes::IMAGE->value)->columnSpanFull(),
                        ])
                    ])->visible(fn(Get $get) => in_array($get('type'), [SlideTypes::BG_IMAGE_AND_TEXT->value, SlideTypes::IMAGE->value]))->columnSpanFull(),
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table {
        return $table->defaultSort('order_column')
            ->reorderable('order_column')
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')->label('Título')->searchable(),
                ToggleColumn::make('show')->label('Mostrar'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
