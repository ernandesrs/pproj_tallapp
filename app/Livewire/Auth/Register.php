<?php

namespace App\Livewire\Auth;

use App\Services\UserService;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Register extends Component
{
    use Interactions;

    public string $first_name = '';

    public string $last_name = '';

    public string $username = '';

    public string $email = '';

    public string $gender = '';

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * Render view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire..auth.register')
            ->layout('components.layouts.auth', [
                'seo' => (object) [
                    'title' => 'Criar uma conta'
                ]
            ]);
    }

    /**
     * Register account
     * @return void
     */
    public function register()
    {
        $validated = $this->validate(UserService::rules()::creationRules());

        if (!UserService::create($validated, ['send_verification_link' => true])) {
            $this->dialog()
                ->error('Oops!', 'Houve um erro de ao criar a conta, verifique os dados e tente de novo.')
                ->send();
            return;
        }

        $this->dialog()
            ->success('Conta criada!', 'Um e-mail de verificação foi enviada para o seu e-mail, mas você já pode acessar sua conta.')
            ->flash()
            ->send();

        $this->redirect(route('auth.login'));
    }
}
