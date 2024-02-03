<?php

namespace App\Filament\Pages;

use App\Models\DengueCaseTable;
use App\Models\LarvaRecordTable;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Illuminate\Support\Facades\DB;

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

        return DengueCaseTable::where('sub_district', $user->subDistrict->name)
            ->groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }

    public function getDengueDistrictCount()
    {
        return DengueCaseTable::select(DB::raw('COUNT(DISTINCT district) as count'))
            ->whereNotNull('district')
            ->count() ?? 0;
    }

    public function getDengueRwCount()
    {
        return DengueCaseTable::select(DB::raw('COUNT(DISTINCT rw) as count'))
            ->whereNotNull('rw')
            ->count() ?? 0;
    }

    public function getLarvaData()
    {
        $user = auth()->user()->profile;

        return LarvaRecordTable::where('sub_district', $user->subDistrict->name)
            ->groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();
    }

    public function getLarvaDistrictCount()
    {
        return LarvaRecordTable::select(DB::raw('COUNT(DISTINCT district) as count'))
            ->whereNotNull('district')
            ->count() ?? 0;
    }

    public function getLarvaRwCount()
    {
        return LarvaRecordTable::select(DB::raw('COUNT(DISTINCT rw) as count'))
            ->whereNotNull('rw')
            ->count() ?? 0;
    }
}
