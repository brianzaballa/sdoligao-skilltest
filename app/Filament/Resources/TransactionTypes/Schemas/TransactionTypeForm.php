<?php

namespace App\Filament\Resources\TransactionTypes\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Transaction Type Description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Select::make('expense_type')
                    ->label('Expense Type')
                    ->options([
                        'MOOE' => 'MOOE — Maintenance and Other Operating Expenses',
                        'PS'   => 'PS — Personnel Services',
                        'CO'   => 'CO — Capital Outlay',
                    ])
                    ->required()
                    ->native(false),

                TextInput::make('uacs_code')
                    ->label('UACS Code')
                    ->required()
                    ->maxLength(50)
                    ->placeholder('e.g. 5-02-01-010'),

                Repeater::make('attachments')
                    ->label('Required Attachments')
                    ->relationship()
                    ->schema([
                        TextInput::make('document_name')
                            ->label('Document Name')
                            ->required()
                            ->maxLength(255)
                            ->datalist([
                                'Disbursement Voucher',
                                'Scanned Check/s',
                                'Approved Itinerary of Travel - Appendix 45',
                                'Memorandum',
                                'Approved Travel Order',
                                'Certificate of Travel Completed',
                                'Certificate of Appearance/Attendance/Participation',
                                'Flight Ticket',
                                'Boat or Bus Ticket',
                                'Boarding Pass',
                                'Terminal Fees',
                                'OR - RER for expenses amounting to more than 300 but not exceeding 1000',
                                'CENRR',
                                'Documentation/Pictures',
                            ]),
                    ])
                    ->addActionLabel('Add Required Document')
                    ->reorderable()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
