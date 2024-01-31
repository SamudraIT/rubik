<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuperVisorStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            StatsOverviewWidget\Stat::make(
                label: 'Total Laporan Jentik',
                value: 2
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Laporan Kasus DBD',
                value: 2
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Penghuni',
                value: 2
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Fasilitas Umum',
                value: 2
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Angka Jentik',
                value: 2
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Angka Bebas Jentik',
                value: 2
            ),
        ];
    }
}
