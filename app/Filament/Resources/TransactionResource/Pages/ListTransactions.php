<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Filament\Resources\TransactionResource\Widgets\TransactionOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;
    protected static ?string $title = 'Transações';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Cadastrar'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TransactionOverview::make(['Total']),
        ];
    }
}
