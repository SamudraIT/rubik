<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LarvaLocationRecordResource\Pages;
use App\Filament\Resources\LarvaLocationRecordResource\RelationManagers;
use App\Models\LarvaLocationRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LarvaLocationRecordResource extends Resource
{
    protected static ?string $model = LarvaLocationRecord::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLarvaLocationRecords::route('/'),
            'create' => Pages\CreateLarvaLocationRecord::route('/create'),
            'edit' => Pages\EditLarvaLocationRecord::route('/{record}/edit'),
        ];
    }
}
