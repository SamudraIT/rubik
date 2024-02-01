<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SuperVisorDengueChart;
use App\Filament\Widgets\SuperVisorDengueTable;
use App\Filament\Widgets\SuperVisorLarvaTable;
use App\Filament\Widgets\SuperVisorStatsOverview;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class SuperVisorDashboard extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static string $view = 'filament.pages.super-visor-dashboard';

    protected function beforeBooted()
    {
        $completed_profile = auth()->user()->profile;

        if (!$completed_profile) {
            return redirect('dashboard/profile');
        }
    }

    public function getTitle(): string
    {
        return "Dashboard";
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SuperVisorStatsOverview::class,
            SuperVisorDengueTable::class,
            SuperVisorLarvaTable::class,
            SuperVisorDengueChart::class
        ];
    }

}
