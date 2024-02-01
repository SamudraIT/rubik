<?php

namespace App\Filament\Resources\DengueCaseReportResource\Pages;

use App\Filament\Resources\DengueCaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDengueCaseReport extends EditRecord
{
    protected static string $resource = DengueCaseReportResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['diseases_symptom'] = explode(', ', $data['diseases_symptom']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
