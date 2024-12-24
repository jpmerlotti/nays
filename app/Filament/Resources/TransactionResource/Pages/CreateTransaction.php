<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Services\V1\TransactionService;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected static ?string $title = 'Cadastrar Transação';

    protected function handleRecordCreation(array $data): Model
    {
        $service = app(TransactionService::class);

        return $service->create($data);
    }

    protected function getRedirectUrl(): string
    {
        return ListTransactions::getUrl();
    }
}
