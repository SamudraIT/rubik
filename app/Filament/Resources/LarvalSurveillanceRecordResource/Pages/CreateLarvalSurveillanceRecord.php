<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use App\Models\LarvaLocationRecord;
use App\Models\LarvaRecordTable;
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
            $data['sub_district_id'] = $profile['sub_district_id'];
            $data['rw'] = $profile['rw'];
        }
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data['larva_location'] = implode(", ", $data['larva_location']);

        $newRecord = static::getModel()::create($data);

        $larva_location_data = [
            'larva_location' => $data['larva_location'],
            'status' => $data['status'],
            'reporter_code' => $data['reporter_code'],
            'larval_surveillance_record_id' => $newRecord['id']
        ];

        LarvaLocationRecord::create($larva_location_data);


        $profile = Profile::where('user_id', $data['user_id'])->first();
        LarvaRecordTable::create([
            'district' => $profile->subDistrict->name,
            'sub_district' => $profile->subDistrict->district->name,
            'rw' => $data['rw'],
            'larval_surveillance_record_id' => $newRecord['id']
        ]);

        return $newRecord;
    }
}
