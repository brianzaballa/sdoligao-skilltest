<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionStatusOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $statuses = [
            'draft'      => ['label' => 'Draft',       'color' => 'gray',    'icon' => 'heroicon-o-pencil-square'],
            'for-review' => ['label' => 'For Review',  'color' => 'warning', 'icon' => 'heroicon-o-clock'],
            'approved'   => ['label' => 'Approved',    'color' => 'info',    'icon' => 'heroicon-o-check-badge'],
            'paid'       => ['label' => 'Paid',        'color' => 'success', 'icon' => 'heroicon-o-banknotes'],
            'cancelled'  => ['label' => 'Cancelled',   'color' => 'danger',  'icon' => 'heroicon-o-x-circle'],
        ];

        // Aggregate all statuses in one query
        $summary = Transaction::query()
            ->selectRaw('status, COUNT(*) as total_count, SUM(amount) as total_amount')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $totalCount  = $summary->sum('total_count');
        $totalAmount = $summary->sum('total_amount');

        $stats = [
            Stat::make('Total Transactions', number_format($totalCount))
                ->description('₱ ' . number_format($totalAmount, 2) . ' total')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack'),
        ];

        foreach ($statuses as $key => $meta) {
            $row    = $summary->get($key);
            $count  = $row ? (int) $row->total_count : 0;
            $amount = $row ? (float) $row->total_amount : 0;

            $stats[] = Stat::make($meta['label'], number_format($count))
                ->description('₱ ' . number_format($amount, 2))
                ->descriptionIcon($meta['icon'])
                ->color($meta['color'])
                ->icon($meta['icon']);
        }

        return $stats;
    }
}
