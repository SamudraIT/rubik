<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use App\Models\LarvaLocationRecord;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLarvalSurveillanceRecord extends EditRecord
{
    protected static string $resource = LarvalSurveillanceRecordResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $larvaLoc = LarvaLocationRecord::where('larval_surveillance_record_id', $data['id'])->first();
        $data['larva_location'] = explode(', ', $larvaLoc['larva_location']);
        $data['status'] = $larvaLoc['status'];

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
