<?php

namespace App\Filament\Resources\Store\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Nette\Utils\ImageColor;

class StudentsTable {

    public static function configure(Table $table): Table {
        return $table
            ->columns([
                ImageColumn::make('profile_image_url')->label('Foto/Avatar')->circular()->width(48),
                TextColumn::make('first_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Apellidos')->searchable()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
