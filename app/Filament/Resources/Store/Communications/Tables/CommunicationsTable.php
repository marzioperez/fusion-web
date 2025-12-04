<?php

namespace App\Filament\Resources\Store\Communications\Tables;

use App\Enums\Status;
use App\Jobs\ProcessCommunication;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CommunicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')->label('Subject')->searchable(),
                TextColumn::make('total_recipients')->label('Total recipients')->numeric(),
                TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    Status::FINISHED->value => 'success',
                    Status::QUEUED->value => 'warning',
                    Status::ERROR->value => 'danger',
                    default => 'primary'
                }),
                TextColumn::make('sent_at')->label('Sent at')->date('d/m/Y')->searchable()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('resend')
                    ->label('Resend')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => in_array($record->status, [
                        Status::FINISHED->value,
                        Status::ERROR->value,
                    ], true))->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => Status::QUEUED->value,
                            'total_recipients' => null,
                            'sent_at' => null,
                        ]);

                        ProcessCommunication::dispatch($record->id);
                    }),
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
