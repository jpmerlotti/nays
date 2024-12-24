<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SchedulingCalendarWidget;
use App\Filament\Widgets\SystemInfoWidget;
use Filament\Pages\Dashboard;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Home extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.home';

    protected static ?string $title = 'Página Inicial';

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            SystemInfoWidget::class,
        ];
    }
}
