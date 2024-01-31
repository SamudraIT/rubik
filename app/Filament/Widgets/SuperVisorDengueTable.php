<?php

namespace App\Filament\Widgets;

use App\Models\DengueCaseReport;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                DengueCaseReport::query()
            )
            ->columns([
                TextColumn::make('district.name')
                    ->label('Kecamatan'),
                TextColumn::make('district.sub_district.name')
                    ->label('Kelurahan'),
                TextColumn::make('user.profile.rw')
                    ->label('RW')
            ]);
    }
}
