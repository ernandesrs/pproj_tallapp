<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\UserService;
use Livewire\Attributes\Locked;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class PasswordReset extends Component
{
    use Interactions;

    public bool $validToken = false;

    #[Locked]
    public string $token = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Mount
     * @param string $token
     * @return void
     */
    public function mount(string $token)
    {
        $validator = \Validator::make(['token' => $token], UserService::rules()::passwordResetTokenRules());
        $this->validToken = !$validator->fails();
    }

    /**
     * Render view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire..auth.password-reset')
            ->layout('components.layouts.auth', [
                'seo' => (object) [
                    'title' => 'Recuperação de senha'
                ]
            ]);
    }

    /**
     * Password reset
     * @return void
     */
    public function passwordReset()
    {
        $validated = $this->validate(UserService::rules()::passwordRules());

        $email = \Str::fromBase64(explode('|', $this->token)[0]);

        $user = User::where('email', $email)->firstOrFail();
        if (!UserService::updatePassword($validated, $user, true)) {
            $this->dialog()
                ->error('Erro!', 'Não foi possível atualizar sua senha, confira os dados e tente de novo.')
                ->send();
            return;
        }

        $this->toast()
            ->success('Atualizada!', 'Sua senha foi atualizada com sucesso.')
            ->flash()
            ->send();

        $this->redirect(route('auth.login'));
    }
}
