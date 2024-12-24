<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Services\V1\TransactionService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->modalHeading('Remover Transação')
                ->modalDescription('Essa ação não pode ser desfeita.')
                ->modalSubmitActionLabel('Remover')
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $service = app(TransactionService::class);

        $service->update($record->id, $data);

        return $record;
    }
}
