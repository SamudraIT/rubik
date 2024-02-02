<?php

namespace App\Filament\Pages;

use App\Models\DengueCaseReport;
use App\Models\DengueCaseTable;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;

class FormCreateDengueCase extends Page
{
    use HasPageShield;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.form-create-dengue-case';

    public ?array $data = [];

    public function mount()
    {
        return $this->form->fill();
    }

    public function form(Form $form): Form
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
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        try {
            $user_profile = auth()->user()->profile;
            $data = $this->form->getState();
            $data['diseases_symptom'] = implode(", ", $data['diseases_symptom']);

            $data['sub_district_id'] = $user_profile['sub_district_id'];
            $data['rw'] = $user_profile['rw'];
            $data['user_id'] = auth()->user()->id;

            $newRecord = DengueCaseReport::create($data);

            DengueCaseTable::create([
                'district' => $user_profile->subDistrict->name,
                'sub_district' => $user_profile->subDistrict->district->name,
                'rw' => $data['rw'],
                'dengue_case_report_id' => $newRecord['id']
            ]);


        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title('Data berhasil di tambahkan')
            ->send();

        $this->form->fill();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Submit')
                ->submit('save')
        ];
    }

    public function getTitle(): string
    {
        return 'Form Pencatatan Kasus DBD';
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('kasus-dbd')
                ->label('Form Pencatatan Jentik')
                ->url(FormCreateLarvaRecord::getUrl())
        ];
    }
}
