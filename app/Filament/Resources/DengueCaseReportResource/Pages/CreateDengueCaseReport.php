<?php

namespace App\Filament\Resources\DengueCaseReportResource\Pages;

use App\Filament\Resources\DengueCaseReportResource;
use App\Models\DengueCaseTable;
use App\Models\Profile;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDengueCaseReport extends CreateRecord
{
    protected static string $resource = DengueCaseReportResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['diseases_symptom'] = implode(", ", $data['diseases_symptom']);

        $profile = Profile::where('user_id', $data['user_id'])->first();

        $newRecord = static::getModel()::create($data);

        DengueCaseTable::create([
            'district' => $profile->subDistrict->name,
            'sub_district' => $profile->subDistrict->district->name,
            'rw' => $data['rw'],
            'dengue_case_report_id' => $newRecord['id']
        ]);

        return $newRecord;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $profile = Profile::where('user_id', $data['user_id'])->first();

        $data['sub_district_id'] = $profile['sub_district_id'];
        $data['rw'] = $profile['rw'];

        return $data;
    }
}
