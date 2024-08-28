<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $this->authorize('viewAny', User::class);

        return view('livewire..admin.users.index')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Usuários'
                ]
            ]);
    }
}
