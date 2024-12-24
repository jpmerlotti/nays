<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Agenda extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Agenda';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
