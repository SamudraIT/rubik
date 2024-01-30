<?php

namespace App\Filament\Resources\DengueCaseReportResource\Pages;

use App\Filament\Resources\DengueCaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDengueCaseReport extends EditRecord
{
    protected static string $resource = DengueCaseReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
