<?php

namespace App\Filament\Widgets;

use App\Models\DengueCaseReport;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class SuperVisorDengueChart extends ApexChartWidget
{
    protected static ?string $chartId = 'superVisorDengueChart';

    protected static ?string $heading = 'Laporan kasus DBD';


    protected function getOptions(): array
    {
        $data = DB::table('dengue_case_reports')
            ->select(DB::raw('MONTH(confirmation_date) as month, patient_status, COUNT(*) as count'))
            ->whereNotNull('patient_status')
            ->whereBetween('confirmation_date', [
                Carbon::parse($this->filterFormData['date_start']),
                Carbon::parse($this->filterFormData['date_end']),
            ])
            ->groupBy('month', 'patient_status')
            ->get();

        $transformedData = [];

        foreach ($data as $record) {
            $month = $record->month;
            $patientStatus = $record->patient_status;
            $count = $record->count;

            if (!isset($transformedData[$patientStatus])) {
                $transformedData[$patientStatus] = array_fill(1, 12, 0);
            }

            $transformedData[$patientStatus][$month] = $count;
        }

        $finalData = [];

        foreach ($transformedData as $patientStatus => $counts) {
            $dataForStatus = [
                'name' => $patientStatus,
                'data' => array_values($counts),
            ];

            $finalData[] = $dataForStatus;
        }


        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => $finalData,
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => [
                '#fcd34d',
                '#fbbf24',
                '#f59e0b',

            ],
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->default(now()->subMonth()),
            DatePicker::make('date_end')
                ->default(now()),
        ];
    }

}
