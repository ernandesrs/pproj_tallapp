<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\VerificationToken;
use App\Services\UserService;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ForgotPassword extends Component
{
    use Interactions;

    /**
     * Email
     * @var string
     */
    public string $email = '';

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..auth.forgot-password')
            ->layout('components.layouts.auth', [
                'seo' => (object) [
                    'title' => 'Esquecia a senha'
                ]
            ]);
    }

    /**
     * Request recovery link
     * @return void
     */
    public function requestRecoveryLink()
    {
        $validated = $this->validate(['email' => ['required', 'email', 'exists:users,email']]);

        $user = User::where('email', $validated['email'])->first();

        $lastToken = $user->verificationTokens()->where('to', VerificationToken::TO_PASSWORD_RESET)->first();

        $minutes = 5;
        if ($lastToken && $lastToken->created_at >= now()->subMinutes($minutes)) {
            $this->dialog()
                ->error('Opa!', 'Um e-mail de recuperação já foi enviado a menos de ' . $minutes . ' minutos, aguarde.')
                ->send();
        } else {
            if (!UserService::sendRecoveryLink($user)) {
                $this->dialog()
                    ->error('Ooops!', 'Houve um problema inesperado, entre em contato por e-mail.')
                    ->send();
                return;
            }

            $this->dialog()
                ->success('Pronto!', 'Um e-mail com um link de recuperação foi enviado.')
                ->send();
        }
    }
}
