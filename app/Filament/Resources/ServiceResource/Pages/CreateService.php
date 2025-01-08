<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Services\V1\ServiceService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $service = app(ServiceService::class);

        return $service->create($data);
    }
}
