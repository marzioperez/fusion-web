<?php

namespace App\Filament\Resources\Store\ScheduleEntryMenus\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ScheduleEntryMenusTable {

    public static function configure(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('school')->label('School'),
                TextColumn::make('grade')->label('Grade'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('date')->label('Date')->date('d/m/Y'),
            ])
            ->filters([
                SelectFilter::make('school')->relationship('school', 'name')->multiple(),
                DateRangeFilter::make('date'),
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
