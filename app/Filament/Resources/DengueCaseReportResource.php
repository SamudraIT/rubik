<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DengueCaseReportResource\Pages;
use App\Filament\Resources\DengueCaseReportResource\RelationManagers;
use App\Models\DengueCaseReport;
use App\Models\ModelHasRole;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class DengueCaseReportResource extends Resource
{
    protected static ?string $model = DengueCaseReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Pecatatan Kasus DBD';

    protected static ?string $modelLabel = 'Pecatatan Kasus DBD';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $slug = 'pencatatan-kasus-dbd';

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        $find_role = ModelHasRole::where('model_id', auth()->id())->first();
        $user_role = $find_role->role;

        if ($user->profile && $user->profile->healthcare_professional) {
            return parent::getEloquentQuery()->where('hospital_id', $user->profile->hospital_id);
        } else if ($user->profile && $user->profile->sub_district_id) {
            if ($user_role['name'] == 'penghuni') {
                return parent::getEloquentQuery()->where('sub_district_id', $user->profile->sub_district_id)->where('is_confirm', true);
            } else {
                return parent::getEloquentQuery();
            }
        } else {
            return parent::getEloquentQuery();
        }
    }

    public static function form(Form $form): Form
    {
        $hospitals = DB::table('hospitals')->get();

        return $form
            ->schema([
                Section::make('Informasi Pasien')
                    ->description('Masukan detail informasi pasien')
                    ->schema([
                        TextInput::make('patient_name')
                            ->label('Nama Pasien')
                            ->maxLength(255)
                            ->minLength(2)
                            ->required(),
                        TextInput::make('phone_number')
                            ->label('Nomor Hp Pendamping Pasien')
                            ->maxLength(255)
                            ->minLength(5)
                            ->required(),
                        DatePicker::make('confirmation_date')
                            ->label('Tanggal Konfirmasi')
                            ->required(),
                        DatePicker::make('recovery_date')
                            ->label('Tanggal Berakhir Penyakit')
                            ->required(),
                        Select::make('diseases_symptom')
                            ->label('Gejala Penyakit')
                            ->options([
                                'Demam Tinggi Sampai 40 Derajat' => 'Demam Tinggi Sampai 40 Derajat',
                                'Sakit Kepala' => 'Sakit Kepala',
                                'Nyeri otot tulang atau sendi' => 'Nyeri otot tulang atau sendi',
                                'Nausea' => 'Nausea',
                                'Muntah' => 'Muntah',
                                'Sakit di belakang mata' => 'Sakit di belakang mata',
                                'Pembengkakan di kelenjar getah bening di leher dan selangkangan' => 'Pembengkakan di kelenjar getah bening di leher dan selangkangan',
                                'Bintik-bintik merah atau bercak pada kulit' => 'Bintik-bintik merah atau bercak pada kulit',
                            ])
                            ->multiple()
                            ->required(),
                    ])->columns(2),
                Section::make('Detail Kasus')
                    ->description('Masukan detail informasi kasus')
                    ->schema([
                        Select::make('patient_status')
                            ->label('Status Pasien')
                            ->options([
                                'Sedang dalam Perawatan' => 'Sedang dalam Perawatan',
                                'Sembuh' => 'Sembuh',
                                'Meninggal' => 'Meninggal'
                            ])
                            ->required(),
                        Select::make('report_status')
                            ->label('Status Laporan')
                            ->options([
                                'Terdiagnosa Oleh Dokter' => 'Terdiagnosa Oleh Dokter',
                                'Tidak Terdiagnosa Oleh Dokter' => 'Tidak Terdiagnosa Oleh Dokter'
                            ])
                            ->required(),
                        Select::make('hospital_id')
                            ->label('Lokasi Dirawat')
                            ->options($hospitals->pluck('name', 'id'))
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        $find_role = ModelHasRole::where('model_id', auth()->id())->first();
        $user_role = $find_role->role;
        $actionsTable = [];

        if ($user_role['name'] == 'penghuni') {
            $actionsTable = [
                Tables\Actions\EditAction::make(),
            ];
        } else {
            $actionsTable = [
                Action::make('confirm')
                    ->visible(function (Model $record) {
                        return $record->is_confirm ? false : true;
                    })
                    ->label('Confirm')
                    ->action(function (DengueCaseReport $record) {
                        $record->update([
                            'is_confirm' => true
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Laporan berhasil di konfirmasi')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Kasus')
                    ->color('success')
                    ->modalIcon('heroicon-o-information-circle')
                    ->modalDescription('Anda yakin ingin mengkonfirmasi?')
                    ->modalSubmitActionLabel('Ya, Saya yakin'),
                Action::make('cancel')
                    ->visible(function (Model $record) {
                        return $record->is_confirm ? true : false;
                    })
                    ->label('Cancel')
                    ->action(function (DengueCaseReport $record) {
                        $record->update([
                            'is_confirm' => false
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Konfirmasi Laporan berhasil di batalkan')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Kasus')
                    ->color('danger')
                    ->modalIcon('heroicon-o-information-circle')
                    ->modalDescription('Anda yakin ingin membatalkan konfirmasi?')
                    ->modalSubmitActionLabel('Ya, Saya yakin'),
                Tables\Actions\EditAction::make(),
            ];
        }

        return $table
            ->columns([
                TextColumn::make('patient_name')
                    ->label('Nama Pasien'),
                TextColumn::make('patient_status')
                    ->label('Status Pasien'),
                TextColumn::make('diseases_symptom')
                    ->label('Gejala Penyakit'),
                TextColumn::make('phone_number')
                    ->label('Nomor HP Pendamping'),
                TextColumn::make('confirmation_date')
                    ->label('Tanggal Terkonfirmasi')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions(
                $actionsTable
            )
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
            'index' => Pages\ListDengueCaseReports::route('/'),
            'create' => Pages\CreateDengueCaseReport::route('/create'),
            'edit' => Pages\EditDengueCaseReport::route('/{record}/edit'),
        ];
    }
}
