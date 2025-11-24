<?php

namespace App\Filament\Resources\Store\Orders\Tables;

use App\Enums\Status;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class OrdersTable {

    public static function configure(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('code')->label('Code')->searchable()->sortable(),
                TextColumn::make('first_name')->label('Firstname')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Lastname')->searchable()->sortable(),
                TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    Status::FINISHED->value => 'success',
                    Status::PENDING->value, Status::SCHEDULED->value => 'warning',
                    Status::ERROR->value => 'danger',
                    default => 'primary'
                }),
                TextColumn::make('created_at')->label('Date')->date('d/m/Y')->searchable()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
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
