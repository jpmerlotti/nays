<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total', function (): string {
                $total = 0;
                foreach (Transaction::all(['value_cents', 'type']) as $value) {
                    $total += $value->type == 'entry' ? $value->value_cents : $value->value_cents * -1;
                }
                return 'R$ ' . number_format($total / 100, 2, ',', '.');
            })
        ];
    }
}
