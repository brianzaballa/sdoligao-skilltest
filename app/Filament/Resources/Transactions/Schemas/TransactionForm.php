<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Transaction;
use App\Models\TransactionType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('transaction_type_id')
                    ->label('Transaction Type')
                    ->relationship('transactionType', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),

                TextInput::make('reference_no')
                    ->label('Reference No.')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->placeholder('e.g. DV-2025-001'),

                DatePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required()
                    ->native(false)
                    ->default(today()),

                TextInput::make('payee')
                    ->label('Payee / Supplier')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('particulars')
                    ->label('Particulars')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('amount')
                    ->label('Amount (₱)')
                    ->required()
                    ->numeric()
                    ->prefix('₱')
                    ->minValue(0),

                Select::make('status')
                    ->label('Status')
                    ->options(Transaction::STATUSES)
                    ->required()
                    ->default('draft')
                    ->native(false),

                Textarea::make('remarks')
                    ->label('Remarks')
                    ->rows(2)
                    ->nullable()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
