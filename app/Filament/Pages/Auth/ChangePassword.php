<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use App\Services\V1\UserService;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.auth.change-password';

    public function getHeading(): string
    {
        return '';
    }

    public array $data = [];
    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
                Section::make('Trocar de Senha')
                    ->description('Aqui você pode criar uma nova senha')
                    ->schema([
                        TextInput::make('current_password')
                        ->label('Senha atual')
                        ->password()
                        ->revealable()
                        ->placeholder('')
                        ->required(),
                        Placeholder::make('warning')
                            ->label('Sua nova senha deve conter no pelo menos 8 caracteres sendo números e letras'),
                        Fieldset::make('newPassword')
                        ->label('Nova Senha')
                        ->schema([
                                TextInput::make('new_password')
                                    ->label('Nova senha')
                                    ->password()
                                    ->revealable()
                                    ->required()
                                    ->dehydrated(fn($state): bool => filled($state))
                                    ->dehydrateStateUsing(fn($state): string => Hash::make($state))
                                    ->same('new_password_confirmation')
                                    ->live(debounce: 500)
                                    ->autofocus(),
                                TextInput::make('new_password_confirmation')
                                    ->label('Confirmar Nova Senha')
                                    ->password()
                                    ->revealable()
                                    ->required()
                                    ->placeholder('')
                                    ->dehydrated(false),
                            ]),
                        Actions::make([
                            Action::make('save')
                                ->label('Salvar')
                                ->action(fn () => $this->save()),
                            Action::make('cancel')
                                ->label('Voltar')
                                ->outlined()
                                ->color('gray')
                        ])
                    ])
            ])->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState(); //@phpstan-ignore-line

            $service = app(UserService::class);

            $service->changePassword($this->user, $data);
        } catch (\Exception $exception) {
            Notification::make()
                ->danger()
                ->title($exception->getMessage())
                ->send();

            return;
        }

        if (request()->hasSession() && array_key_exists('new_password', $data)) {
            request()->session()->put(['password_hash_' . Filament::getAuthGuard() => $data['new_password']]);
        }

        $this->form->fill(); //@phpstan-ignore-line

        Notification::make()
            ->success()
            ->title('Senha alterada com sucesso')
            ->send();
    }
}
