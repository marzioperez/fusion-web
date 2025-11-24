<?php

namespace App\Filament\Resources\Store\Orders\Schemas;

use App\Models\Order;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm {

    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make()->schema([
                        TextInput::make('code')->disabled()->columnSpan(4),
                        TextInput::make('first_name')->disabled()->columnSpan(4),
                        TextInput::make('last_name')->disabled()->columnSpan(4),
                        TextInput::make('email')->disabled()->columnSpan(6),
                        TextInput::make('phone')->disabled()->columnSpan(6),
                    ])->columns([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ]),

                    Section::make()->schema([
                        TextEntry::make('sub_total')->label('Subtotal')->state(fn (Order $record): ?string => '$' . $record->sub_total)->columnSpan(3),
                        TextEntry::make('credits')->label('Credits')->state(fn (Order $record): ?string => '$' . $record->credits)->columnSpan(3),
                        TextEntry::make('processing_fee')->label('Processing fee')->state(fn (Order $record): ?string => '$' . $record->processing_fee)->columnSpan(3),
                        TextEntry::make('total')->label('Total')->state(fn (Order $record): ?string => '$' . $record->total)->columnSpan(3),
                    ])->columns([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ]),
                ])->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),

                Section::make()->schema([
                    TextEntry::make('created_at')->label('Order date')->state(fn (Order $record): ?string => $record->created_at?->diffForHumans()),
                    TextEntry::make('updated_at')->label('Last modified at')->state(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                    TextEntry::make('stripe_payment_intent_id')->label('Stripe ID')->state(fn (Order $record): ?string => $record->stripe_payment_intent_id),
                ])->columnSpan(['lg' => 1])->hidden(fn (?Order $record) => $record === null),
            ])->columns(3);
    }
}
