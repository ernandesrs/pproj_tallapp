<?php

namespace App\Livewire\Auth;

use App\Services\UserService;
use Livewire\Component;

class RegisterVerification extends Component
{
    public bool $success = false;

    /**
     * Mount
     * @param string $token
     * @return void
     */
    public function mount(string $token)
    {
        $validator = \Validator::make(['token' => $token], UserService::rules()::registerVerificationTokenRules());
        if ($validator->fails()) {
            $this->success = false;
        } else {
            $this->success = UserService::registerVerifyByToken($validator->validated());
        }
    }

    /**
     * Renver view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire..auth.register-verification')
            ->layout('components.layouts.auth', [
                'seo' => (object) [
                    'title' => 'Verificação de registro'
                ]
            ]);
    }
}
