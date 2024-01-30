<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLarvalSurveillanceRecords extends ListRecords
{
    protected static string $resource = LarvalSurveillanceRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
