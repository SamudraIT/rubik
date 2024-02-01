<?php

namespace App\Filament\Pages;

use App\Models\DengueCaseTable;
use App\Models\LarvaRecordTable;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class TabelBerjenjang extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static string $view = 'filament.pages.tabel-berjenjang';

    public function getDengueData()
    {
        return DengueCaseTable::groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }

    public function getLarvaData()
    {
        return LarvaRecordTable::groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }
}
