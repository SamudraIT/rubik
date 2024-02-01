<?php

namespace App\Filament\Widgets;

use App\Models\DengueCaseReport;
use App\Models\LarvaLocationRecord;
use App\Models\LarvalSurveillanceRecord;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SuperVisorStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $larvaLocationRecords = LarvaLocationRecord::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $angkaJentikCount = $larvaLocationRecords->where('status', 'Ada/Positif')->first()->count ?? 0;
        $angkaBebasJentikCount = $larvaLocationRecords->where('status', 'Tidak/Negatif')->first()->count ?? 0;

        return [
            StatsOverviewWidget\Stat::make(
                label: 'Total Laporan Jentik',
                value: LarvalSurveillanceRecord::all()->count() ?? 0
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Laporan Kasus DBD',
                value: DengueCaseReport::all()->count() ?? 0
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Penghuni',
                value: User::all()->count() ?? 0
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Fasilitas Umum',
                value: LarvalSurveillanceRecord::select(DB::raw('COUNT(DISTINCT public_facilities) as count'))
                    ->whereNotNull('public_facilities')
                    ->count() ?? 0
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Angka Jentik',
                value: $angkaJentikCount
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Angka Bebas Jentik',
                value: $angkaBebasJentikCount
            ),
        ];
    }
}
