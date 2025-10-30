<?php

namespace App\Filament\Resources\Cms\Menus\RelationManagers;

use App\Enums\MenuItemTypes;
use App\Models\Menu;
use App\Models\Page;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager {

    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema{
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    Select::make('type')->label('Tipo de elemento')->options([
                        MenuItemTypes::PAGE->value => 'Página',
                        MenuItemTypes::CUSTOM->value => 'Enlace personalizado'
                    ])->live()->columnSpan(6),
                    Select::make('item_id')->label('Elemento')->options(function (Get $get) {
                        $type = $get('type');
                        return match ($type) {
                            MenuItemTypes::PAGE->value => Page::all()->pluck('title', 'id'),
                            default => [],
                        };
                    })->afterStateUpdated(function ($state, Get $get, Set $set) {
                        $type = $get('type');
                        if ($type === MenuItemTypes::PAGE->value) {
                            $page = Page::find($state);
                            $set('name', $page->title);
                            $set('url', ($page->slug === "/" ? '' : route('page', ['slug' => $page->slug])));
                        }
                    })->live()->visible(fn(Get $get) => in_array($get('type'), [MenuItemTypes::PAGE->value]))->columnSpan(6),
                    TextInput::make('name')->label('Nombre')->columnSpanFull(),


                    TextInput::make('url')->label('URL')->readOnly(fn (Get $get) => $get('type') !== MenuItemTypes::CUSTOM->value)
                        ->visible(fn(Get $get) => in_array($get('type'), [MenuItemTypes::PAGE->value, MenuItemTypes::CUSTOM->value]))
                        ->columnSpanFull(),

                    Toggle::make('open_in_new_window')->label('Abrir en nueva ventana')->columnSpan(4),
                    Toggle::make('style_button')->label('Estilo botón')->columnSpan(4),
                    Toggle::make('anchor_button')->label('Botón ancla')->columnSpan(4),
                    Toggle::make('show')->label('Mostrar')->columnSpan(4)->default(true),
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table {
        return $table->defaultSort('order_column')
            ->reorderable('order_column')
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable(),
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
                    DissociateBulkAction::make(),
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
