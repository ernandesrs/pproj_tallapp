<?php

namespace App\Livewire\Admin;

use App\Builders\Page\Breadcrumb;
use Livewire\Component;

class Overview extends Component
{
    public function render()
    {
        $page = new \App\Builders\Page\Page(
            'Visão geral',
            (new Breadcrumb('admin.overview'))
                ->add('Visão geral', ['name' => 'admin.overview'])
        );

        return view('livewire..admin.overview', [
            'page' => $page
        ])->layout('components.layouts.admin', [
                    'page' => $page
                ]);
    }
}
