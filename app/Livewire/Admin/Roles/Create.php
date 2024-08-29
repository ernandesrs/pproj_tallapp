<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire..admin.roles.create')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Novo cargo'
                ]
            ]);
    }
}
