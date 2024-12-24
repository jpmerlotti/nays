<?php

namespace App\Filament\Clusters\Agenda\Resources\TreatmentResource\Pages;

use App\Filament\Clusters\Agenda\Resources\TreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTreatments extends ListRecords
{
    protected static string $resource = TreatmentResource::class;

    protected static ?string $title = 'Atendimentos';

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
