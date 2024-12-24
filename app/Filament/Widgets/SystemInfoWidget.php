<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SystemInfoWidget extends Widget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected int|string|array $columnStart = [
        'default' => 1,
        'md' => 2,
    ];

    protected int|string|array $columnSpan = 1;

    protected static string $view = 'filament.widgets.system-info-widget';
}
