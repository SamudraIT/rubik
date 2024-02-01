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
            'district' => $profile->district->name,
            'sub_district' => $profile->district->sub_district[0]->name,
            'rw' => $data['rw'],
            'dengue_case_report_id' => $newRecord['id']
        ]);

        return $newRecord;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $profile = Profile::where('user_id', $data['user_id'])->first();

        $data['district_id'] = $profile['district_id'];
        $data['rw'] = $profile['rw'];

        return $data;
    }
}
