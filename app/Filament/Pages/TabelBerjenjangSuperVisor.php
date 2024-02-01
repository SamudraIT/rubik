<?php

namespace App\Filament\Pages;

use App\Models\DengueCaseTable;
use App\Models\LarvaRecordTable;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class TabelBerjenjangSuperVisor extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static string $view = 'filament.pages.tabel-berjenjang-super-visor';

    protected function beforeBooted()
    {
        $completed_profile = auth()->user()->profile;

        if (!$completed_profile) {
            return redirect('dashboard/profile');
        }
    }

    public function getDengueData()
    {
        $user = auth()->user()->profile;

        return DengueCaseTable::where('district', $user->district->name)
            ->groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }

    public function getLarvaData()
    {
        $user = auth()->user()->profile;

        return LarvaRecordTable::where('district', $user->district->name)
            ->groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }
}
