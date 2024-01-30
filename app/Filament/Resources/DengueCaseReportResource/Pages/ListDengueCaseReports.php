<?php

namespace App\Filament\Resources\DengueCaseReportResource\Pages;

use App\Filament\Resources\DengueCaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDengueCaseReports extends ListRecords
{
    protected static string $resource = DengueCaseReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
