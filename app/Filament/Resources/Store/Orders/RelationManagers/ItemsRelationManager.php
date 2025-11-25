<?php

namespace App\Filament\Resources\Store\Orders\RelationManagers;

use App\Enums\Status;
use App\Models\Order;
use App\Models\ScheduleEntryMenu;
use App\Models\User;
use Filament\Actions\Action;
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
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->limit(50)->searchable(),
                TextColumn::make('student_name')->label('Student')->searchable(),
                TextColumn::make('student_name')->label('Student'),
                TextColumn::make('date')->label('Date')->date('d/m/Y'),
                TextColumn::make('price')->label('Price')->prefix('$'),
                TextColumn::make('quantity')->label('Quantity')->alignCenter(),
                TextColumn::make('total')->label('Total')->prefix('$'),
                TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    Status::CONFIRMED->value => 'success',
                    Status::PENDING->value, Status::SCHEDULED->value => 'warning',
                    Status::CANCELED->value => 'gray',
                    default => 'primary'
                }),
            ])
            ->filters([
                //TrashedFilter::make(),
            ])
            ->headerActions([
                // CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                Action::make('cancel')->label('Cancel')
                    ->requiresConfirmation()->button()
                    ->modalHeading('Cancel item')
                    ->modalDescription('When you cancel this item, credits will be added to the user account.')
                    ->color('danger')->action(function ($record) {
                        if ($record->status === Status::CONFIRMED->value) {
                            $order = Order::find($record->order_id);
                            if ($order) {
                                $user = User::find($order->user_id);
                                if ($user) {
                                    $user->increment('credits', $record->price);
                                }

                                $schedule_entries = ScheduleEntryMenu::where('order_item_id', $record->id)->get();
                                foreach ($schedule_entries as $entry) {
                                    $entry->delete();
                                }

                                $record->update(['status' => Status::CANCELED->value]);
                                Notification::make()->title('Item cancelled')->success()->send();
                            }
                        } else {
                            Notification::make()->title('This item has already been canceled.')->danger()->send();
                        }
                })
                // EditAction::make(),
                // DissociateAction::make(),
                // DeleteAction::make(),
                // ForceDeleteAction::make(),
                // RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    // DeleteBulkAction::make(),
                    // ForceDeleteBulkAction::make(),
                    // RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
