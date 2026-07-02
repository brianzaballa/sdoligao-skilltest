<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Reference No.')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                TextColumn::make('transactionType.description')
                    ->label('Type')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(40),

                TextColumn::make('payee')
                    ->label('Payee / Supplier')
                    ->searchable()
                    ->wrap()
                    ->limit(35),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('PHP')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('transaction_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft'      => 'gray',
                        'for-review' => 'warning',
                        'approved'   => 'info',
                        'paid'       => 'success',
                        'cancelled'  => 'danger',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => Transaction::STATUSES[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('transactionType.expense_type')
                    ->label('Expense Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MOOE' => 'info',
                        'PS'   => 'success',
                        'CO'   => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Transaction::STATUSES)
                    ->native(false),

                SelectFilter::make('transaction_type_id')
                    ->label('Transaction Type')
                    ->relationship('transactionType', 'description')
                    ->searchable()
                    ->preload()
                    ->native(false),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('transaction_date', 'desc');
    }
}
