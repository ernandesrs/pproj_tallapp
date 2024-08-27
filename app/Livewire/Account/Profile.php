<?php

namespace App\Livewire\Account;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire..account.profile')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Meu perfil'
                ]
            ]);
    }
}
