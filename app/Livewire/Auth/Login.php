<?php

namespace App\Livewire\Auth;

use App\Rules\LoginRules;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Login extends Component
{
    use Interactions;

    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..auth.login')
            ->layout('components.layouts.auth', [
                'seo' => (object) [
                    'title' => 'Acesse sua conta'
                ]
            ]);
    }

    /**
     * Login attempt
     * @return void
     */
    public function attempt(): void
    {
        $validated = $this->validate(LoginRules::loginRules());

        if (!\Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $validated['remember'])) {
            $this->toast()
                ->error('Falha no login!', 'Um ou mais dados de login são inválidos.')
                ->send();
            return;
        }

        $this->redirect(route('front.home'));
    }
}
