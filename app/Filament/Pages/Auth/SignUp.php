<?php

namespace App\Filament\Pages\Auth;

use App\Models\ModelHasRole;
use App\Models\Profile;
use App\Models\Role;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register;

class SignUp extends Register
{

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Informasi Akun')
          ->description('Masukan detail informasi akun')
          ->schema([
            $this->getNameFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent()
          ])->columns(1),
        Section::make('Informasi Pribadi')
          ->description('Masukan detail informasi pribadi')
          ->schema([
            TextInput::make('card_number')
              ->label('No KK')
              ->required()
              ->maxLength(255),
            TextInput::make('address')
              ->label('Alamat')
              ->required()
              ->maxLength(255),
            TextInput::make('rt')
              ->label('RT')
              ->required()
              ->maxLength(255),
            TextInput::make('rw')
              ->label('RW')
              ->required()
              ->maxLength(255),
            Select::make('place_status')
              ->label('Status Hunian')
              ->options([
                'Milik Pribadi' => 'Milik Pribadi',
                'Sewa/Kontrak' => 'Sewa/Kontrak'
              ])
              ->required(),
          ])->columns(1),
      ]);
  }

  public function register(): ?RegistrationResponse
  {
    try {
      $this->rateLimit(2);
    } catch (TooManyRequestsException $exception) {
      Notification::make()
        ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
          'seconds' => $exception->secondsUntilAvailable,
          'minutes' => ceil($exception->secondsUntilAvailable / 60),
        ]))
        ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
          'seconds' => $exception->secondsUntilAvailable,
          'minutes' => ceil($exception->secondsUntilAvailable / 60),
        ]) : null)
        ->danger()
        ->send();

      return null;
    }

    $data = $this->form->getState();

    $user_data = [
      'name' => $data['name'],
      'email' => strtolower(str_replace(' ', '', $data['name'])) . '@gmail.com',
      'password' => $data['password']
    ];

    $user = $this->getUserModel()::create($user_data);

    $role = Role::where('name', 'penghuni')->first();

    $role_data = [
      'role_id' => $role['id'],
      'model_type' => 'App\Models\User',
      'model_id' => $user['id']
    ];

    ModelHasRole::create($role_data);


    $profile_data = [
      'card_number' => $data['card_number'],
      'address' => $data['address'],
      'place_status' => $data['place_status'],
      'user_id' => $user['id'],
      'rt' => $data['rt'],
      'rw' => $data['rw']
    ];

    $profile = Profile::create($profile_data);

    event(new Registered($user));

    $this->sendEmailVerificationNotification($user);

    Filament::auth()->login($user);

    session()->regenerate();

    return app(RegistrationResponse::class);
  }

}