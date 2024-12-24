<?php

namespace App\Filament\Widgets;

use App\Filament\Clusters\Agenda\Resources\TreatmentResource\Pages\CreateTreatment;
use App\Models\Treatment;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class SchedulingCalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Treatment::class;

    public function fetchEvents(array $info): array
    {
        return Treatment::query()
            ->where('created_at', 'LIKE', '%-' . now()->month() . '-%')
            ->get()
            ->map(
                fn(Treatment $data) => EventData::make()
                    ->id($data->id)
                    ->title($data->service->name . ' ' . $data->customer->name)
                    ->start($data->start)
                    ->end($data->start + $data->service->duration)
            )
            ->toArray();
    }

    protected function headerActions(): array
    {
        return [
            Action::make('create.treatment')
                ->label('Cadastrar Atendimento')
                ->color('primary')
                ->url(fn() => CreateTreatment::getUrl())
        ];
    }
}
