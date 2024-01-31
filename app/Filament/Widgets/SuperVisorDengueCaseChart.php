<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SuperVisorDengueCaseChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = DB::table('dengue_case_reports')
            ->select(DB::raw('patient_status, COUNT(*) as count'))
            ->whereNotNull('patient_status')
            ->whereBetween('confirmation_date', [
                now()->startOfYear(),
                now()->endOfYear()
            ])
            ->groupBy('patient_status')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan Kasus DBD',
                    'data' => $data->pluck('count'),
                ]
            ],
            'labels' => $data->pluck('patient_status')
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
