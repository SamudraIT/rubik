<?php

namespace App\Filament\Widgets;

use App\Models\DengueCaseReport;
use App\Models\DengueCaseTable;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class SuperVisorDengueTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->heading('Tabel Berjenjang Kasus DBD')
            ->query(
                DengueCaseTable::query()
            )
            ->columns([
                TextColumn::make('district')
                    ->label('Kecamatan'),
                TextColumn::make('sub_district')
                    ->label('Kelurahan'),
                TextColumn::make('rw')
                    ->label('RW')
            ])
            ->filters([
                Filter::make('district')
                    ->query(fn($query) => $query->selectRaw('district, sub_district, rw, count(*) as counted')->groupBy('district', 'sub_district', 'rw'))
                    ->label('Kecamatan'),
                Filter::make('sub_district')
                    ->query(fn($query) => $query->selectRaw('district, sub_district, rw, count(*) as counted')->groupBy('district', 'sub_district', 'rw'))
                    ->label('Kelurahan'),
                Filter::make('rw')
                    ->query(fn($query) => $query->selectRaw('district, sub_district, rw, count(*) as counted')->groupBy('district', 'sub_district', 'rw'))
                    ->label('RW'),
            ]);
    }
}
