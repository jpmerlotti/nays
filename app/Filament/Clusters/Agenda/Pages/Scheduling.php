<?php

namespace App\Filament\Clusters\Agenda\Pages;

use App\Filament\Clusters\Agenda;
use App\Filament\Widgets\SchedulingCalendarWidget;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Scheduling extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Atendimentos';

    protected static string $view = 'filament.clusters.agenda.pages.scheduling';

    protected static ?string $cluster = Agenda::class;

    public function getHeading(): string|Htmlable
    {
        return '';
    }

    protected function getHeaderWidgetsColumn(): int | array
    {
        return [
            'sm' => 1,
            'md' => 3
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SchedulingCalendarWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create.treatment')
                ->label('Adicionar Atendimento')
                ->action(function () {
                    echo "Deu certo";
                })
                ->color('primary')
        ];
    }
}
