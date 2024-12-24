<?php

namespace App\Filament\Clusters\Agenda\Resources\TreatmentResource\Pages;

use App\Filament\Clusters\Agenda\Resources\TreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTreatment extends EditRecord
{
    protected static string $resource = TreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
