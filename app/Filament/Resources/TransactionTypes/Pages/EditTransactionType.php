<?php

namespace App\Filament\Resources\TransactionTypes\Pages;

use App\Filament\Resources\TransactionTypes\TransactionTypeResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditTransactionType extends EditRecord
{
    protected static string $resource = TransactionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('print_checklist')
                ->label('Print Checklist')
                ->icon(Heroicon::OutlinedPrinter)
                ->color('gray')
                ->url(fn () => route('print.transaction-type.checklist', $this->record))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
