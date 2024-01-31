<?php

namespace App\Filament\Widgets;

use App\Models\LarvalSurveillanceRecord;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class SuperVisorLarvaTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->heading('Tabel Berjenjang Jentik')
            ->query(
                LarvalSurveillanceRecord::query()
            )
            ->columns([
                //
            ]);
    }
}
