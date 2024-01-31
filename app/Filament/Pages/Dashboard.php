<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Dashboard extends BaseDashboard
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

}
