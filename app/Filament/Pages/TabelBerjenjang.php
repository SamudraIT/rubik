<?php

namespace App\Filament\Pages;

use App\Models\DengueCaseTable;
use App\Models\LarvaRecordTable;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Illuminate\Support\Facades\DB;

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

    public function getDengueDistrictCount()
    {
        $dengue_case = DengueCaseTable::get();

        $allDistrictArrays = $dengue_case->map(function ($item) {
            return $item->district;
        });

        $uniqueDistrict = $allDistrictArrays->flatten()->unique();

        $DistrictCount = $uniqueDistrict->count();

        return $DistrictCount;
    }

    public function getDengueSubDistrictCount()
    {
        $dengue_case = DengueCaseTable::get();

        $allSubDistrictArrays = $dengue_case->map(function ($item) {
            return $item->sub_district;
        });

        $uniqueSubDistrict = $allSubDistrictArrays->flatten()->unique();

        $subDistrictCount = $uniqueSubDistrict->count();

        return $subDistrictCount;

    }

    public function getDengueRwCount()
    {
        $dengue_case = DengueCaseTable::get();

        $allRwArrays = $dengue_case->map(function ($item) {
            return $item->rw;
        });

        $uniqueRw = $allRwArrays->flatten()->unique();

        $rwCount = $uniqueRw->count();

        return $rwCount;
    }

    public function getLarvaData()
    {
        return LarvaRecordTable::groupBy(['district', 'sub_district', 'rw'])
            ->selectRaw('count(*) as count, district, sub_district, rw')
            ->get();


    }

    public function getLarvaDistrictCount()
    {
        // return LarvaRecordTable::select(DB::raw('COUNT(DISTINCT district) as count'))
        //     ->whereNotNull('district')
        //     ->count() ?? 0;

        $larvaRecord = LarvaRecordTable::get();

        $allDistrictArrays = $larvaRecord->map(function ($item) {
            return $item->district;
        });

        $uniqueDistrict = $allDistrictArrays->flatten()->unique();

        $DistrictCount = $uniqueDistrict->count();

        return $DistrictCount;
    }

    public function getLarvaSubDistrictCount()
    {
        // return LarvaRecordTable::select(DB::raw('COUNT(DISTINCT sub_district) as count'))
        //     ->whereNotNull('sub_district')
        //     ->count() ?? 0;
        $larvaRecord = LarvaRecordTable::get();

        $allDistrictArrays = $larvaRecord->map(function ($item) {
            return $item->sub_district;
        });

        $uniqueDistrict = $allDistrictArrays->flatten()->unique();

        $DistrictCount = $uniqueDistrict->count();

        return $DistrictCount;
    }

    public function getLarvaRwCount()
    {
        // return LarvaRecordTable::select(DB::raw('COUNT(DISTINCT rw) as count'))
        //     ->whereNotNull('rw')
        //     ->count() ?? 0;

        $larvaRecord = LarvaRecordTable::get();

        $allDistrictArrays = $larvaRecord->map(function ($item) {
            return $item->rw;
        });

        $uniqueDistrict = $allDistrictArrays->flatten()->unique();

        $DistrictCount = $uniqueDistrict->count();

        return $DistrictCount;
    }
}
