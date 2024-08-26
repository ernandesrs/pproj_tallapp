<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire..admin.roles.index')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Cargos'
                ]
            ]);
    }
}
