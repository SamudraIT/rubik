<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use App\Models\LarvaLocationRecord;
use App\Models\Profile;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateLarvalSurveillanceRecord extends CreateRecord
{
    protected static string $resource = LarvalSurveillanceRecordResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $profile = Profile::where('user_id', $data['user_id'])->first();

        if ($profile) {
            $data['district_id'] = $profile['district_id'];
        }
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data['larva_location'] = implode(", ", $data['larva_location']);

        $larva_location_data = [
            'larva_location' => $data['larva_location'],
            'status' => $data['status'],
            'reporter_code' => $data['reporter_code']
        ];

        LarvaLocationRecord::create($larva_location_data);

        unset($data['larva_location']);
        unset($data['status']);

        return static::getModel()::create($data);
    }
}
