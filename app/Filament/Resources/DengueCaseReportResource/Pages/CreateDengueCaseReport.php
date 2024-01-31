<?php

namespace App\Filament\Resources\DengueCaseReportResource\Pages;

use App\Filament\Resources\DengueCaseReportResource;
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

        return static::getModel()::create($data);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $profile = Profile::where('user_id', $data['user_id'])->first();

        $data['district_id'] = $profile['district_id'];

        return $data;
    }
}
