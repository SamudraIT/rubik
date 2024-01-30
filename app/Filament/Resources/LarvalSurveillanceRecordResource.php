<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LarvalSurveillanceRecordResource\Pages;
use App\Filament\Resources\LarvalSurveillanceRecordResource\RelationManagers;
use App\Models\LarvalSurveillanceRecord;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LarvalSurveillanceRecordResource extends Resource
{
    protected static ?string $model = LarvalSurveillanceRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Pecatatan Jentik';

    protected static ?string $modelLabel = 'Pecatatan Jentik';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $slug = 'pencatatan-jentik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pelapor')
                    ->description('Masukan detail informasi pelapor')
                    ->schema([
                        TextInput::make('reporter_name')
                            ->label('Nama Pelapor')
                            ->maxLength(255)
                            ->minLength(2)
                            ->required(),
                        TextInput::make('reporter_code')
                            ->label('Kode Pelapor')
                            ->maxLength(255)
                            ->minLength(2)
                            ->required(),
                    ])->columns(2),

                Section::make('Informasi Laporan')
                    ->description('Masukan detail informasi laporan')
                    ->schema([
                        Select::make('ovitrap_ownership')
                            ->label('Kepemilikan Ovitrap')
                            ->options([
                                'Dengan Ovitrap' => 'Dengan Ovitrap',
                                'Tanpa Ovitrap' => 'Tanpa Ovitrap'
                            ])
                            ->required(),
                        Select::make('location')
                            ->label('Tempat')
                            ->reactive()
                            ->options([
                                'Rumah Warga' => 'Rumah Warga',
                                'Tempat dan Fasilitas Umum' => 'Tempat dan Fasilitas Umum'
                            ])
                            ->requiredWith('public_facilities'),
                        TextInput::make('public_facilities')
                            ->label('Nama Fasilitas Umum')
                            ->requiredWith('location')
                            ->hidden(fn(Get $get) => $get('location') != 'Tempat dan Fasilitas Umum'),
                        DatePicker::make('reported_date')
                            ->label('Tanggal Pelaporan')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->directory('gambar-jentik')
                            ->storeFileNamesIn('original_filename')
                            ->required()
                    ])->columns(2),

                Section::make('Keberadaan Jentik')
                    ->description('Masukan detail keberadaan jentik')
                    ->schema([
                        Select::make('larva_location')
                            ->label('Lokasi Jentik')
                            ->options([
                                'Dispenser' => 'Dispenser',
                                'Bak Mandi' => 'Bak Mandi',
                                'Bak Belakang Kulkas' => 'Bak Belakang Kulkas',
                                'Tatakan Pot Luar Ruangan' => 'Tatakan Pot Luar Ruangan',
                                'Tempat Minum Hewan Peliharaan' => 'Tempat Minum Hewan Peliharaan',
                                'Tempat Penampungan Air Hujan/AC' => 'Tempat Penampungan Air Hujan/AC',
                                'Ban Bekas' => 'Ban Bekas',
                                'Kaleng/Botol Bekas' => 'Kaleng/Botol Bekas',
                                'Ovitrap' => 'Ovitrap',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->multiple()
                            ->required(),
                        Select::make('status')
                            ->label('Status Jentik')
                            ->options([
                                'Ada/Positif' => 'Ada/Positif',
                                'Tidak/Negatif' => 'Tidak/Negatif'
                            ])
                            ->required(),
                    ])->columns(2)
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
            'index' => Pages\ListLarvalSurveillanceRecords::route('/'),
            'create' => Pages\CreateLarvalSurveillanceRecord::route('/create'),
            'edit' => Pages\EditLarvalSurveillanceRecord::route('/{record}/edit'),
        ];
    }
}
