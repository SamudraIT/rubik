<?php

namespace App\Filament\Pages;

use App\Models\LarvaLocationRecord;
use App\Models\LarvalSurveillanceRecord;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;

class FormCreateLarvaRecord extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static string $view = 'filament.pages.form-create-larva-record';

    protected static ?string $navigationLabel = 'Dashboard';

    public ?array $data = [];

    protected function beforeBooted()
    {
        $completed_profile = auth()->user()->profile;

        if (!$completed_profile) {
            return redirect('dashboard/profile');
        }
    }

    public function mount()
    {
        return $this->form->fill();
    }

    public function form(Form $form): Form
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
                    ])
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        try {
            $user_profile = auth()->user()->profile;
            $data = $this->form->getState();
            $data['larva_location'] = implode(", ", $data['larva_location']);

            $data['district_id'] = $user_profile['district_id'];
            $data['rw'] = $user_profile['rw'];
            $data['user_id'] = $user_profile['user_id'];

            LarvaLocationRecord::create([
                'larva_location' => $data['larva_location'],
                'status' => $data['status'],
                'reporter_code' => $data['reporter_code']
            ]);

            unset($data['larva_location']);
            unset($data['status']);

            LarvalSurveillanceRecord::create($data);
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
        return 'Form Pencatatan Jentik';
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('kasus-dbd')
                ->label('Form Kasus DBD')
                ->url(FormCreateDengueCase::getUrl())
        ];
    }
}
