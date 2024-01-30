<?php

namespace App\Filament\Resources\LarvaLocationRecordResource\Pages;

use App\Filament\Resources\LarvaLocationRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLarvaLocationRecords extends ListRecords
{
    protected static string $resource = LarvaLocationRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
