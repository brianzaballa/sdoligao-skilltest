<?php

namespace App\Filament\Resources\TransactionTypes\Tables;

use App\Models\TransactionType;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('expense_type')
                    ->label('Expense Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MOOE' => 'info',
                        'PS'   => 'success',
                        'CO'   => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('uacs_code')
                    ->label('UACS Code')
                    ->copyable()
                    ->fontFamily('mono'),

                TextColumn::make('attachments_count')
                    ->label('Required Docs')
                    ->counts('attachments')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('print_checklist')
                    ->label('Print Checklist')
                    ->icon(Heroicon::OutlinedPrinter)
                    ->color('gray')
                    ->url(fn (TransactionType $record): string => route('print.transaction-type.checklist', $record))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('description');
    }
}
