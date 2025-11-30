<?php

namespace App\Filament\Resources\Store\Orders\Tables;

use App\Enums\Status;
use App\Jobs\ProcessOrder;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Stripe\StripeClient;

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
                    Status::ERROR->value, Status::CANCELED->value => 'danger',
                    default => 'primary'
                }),
                TextColumn::make('created_at')->label('Date')->date('d/m/Y')->searchable()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('reprocess')->label('Stripe validate')
                    ->visible(fn ($record): bool => $record->status == Status::PENDING->value)
                    ->color('success')->action(function ($record) {
                        $stripe = new StripeClient(config('services.stripe.secret'));
                        $payment_intent = $stripe->paymentIntents->retrieve($record->stripe_payment_intent_id, []);
                        if ($payment_intent->status === 'succeeded') {
                            ProcessOrder::dispatch($record->code);
                            Notification::make()
                                ->title('Payment completed')
                                ->body("The order {$record->code} has been processed successfully. Please wait for the confirmation email.")
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Payment not completed')
                                ->body("Current Stripe status: {$payment_intent->status}")
                                ->warning()
                                ->send();
                        }
                    }),
                Action::make('cancel')->label('Cancel')
                    ->visible(fn ($record): bool => $record->status == Status::PENDING->value)
                    ->requiresConfirmation()
                    ->color('danger')->action(function ($record) {
                        $record->update(['status' => Status::CANCELED->value]);
                        Notification::make()
                            ->title('Order canceled')
                            ->body("The order : {$record->code} has been canceled.")
                            ->danger()
                            ->send();
                    }),
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
