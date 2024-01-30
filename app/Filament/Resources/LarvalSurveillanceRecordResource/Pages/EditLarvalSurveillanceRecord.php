<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLarvalSurveillanceRecord extends EditRecord
{
    protected static string $resource = LarvalSurveillanceRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
