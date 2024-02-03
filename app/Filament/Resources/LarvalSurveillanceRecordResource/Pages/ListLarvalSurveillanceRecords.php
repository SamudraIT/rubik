<?php

namespace App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;

use App\Filament\Resources\LarvalSurveillanceRecordResource;
use App\Models\ModelHasRole;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLarvalSurveillanceRecords extends ListRecords
{
    protected static string $resource = LarvalSurveillanceRecordResource::class;

    protected function getHeaderActions(): array
    {
        $find_role = ModelHasRole::where('model_id', auth()->id())->first();
        $user_role = $find_role->role;

        if ($user_role['name'] == 'super_admin') {
            return [
                Actions\CreateAction::make(),
                ExportAction::make()
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withFilename(fn($resource) => $resource::getModelLabel() . '_' . date('Y-m-d'))
                            ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                            ->withColumns([
                                Column::make('updated_at')
                            ])
                    ])
            ];
        } else {
            return [
                Actions\CreateAction::make(),
            ];
        }
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek())),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth())),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear())),
        ];
    }
}
