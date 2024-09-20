<?php

namespace App\Livewire\Admin;

use App\Builders\Page\Breadcrumb;
use App\Traits\Pages\PageTrait;
use Livewire\Component;

class Overview extends Component
{
    use PageTrait;

    /**
     * Page
     * @param mixed $model
     * @return \App\Builders\Page\Page
     */
    static function page(mixed $model = null): \App\Builders\Page\Page
    {
        return new \App\Builders\Page\Page(
            'Visão geral',
            (new Breadcrumb('admin.overview'))
                ->add('Visão geral', ['name' => 'admin.overview'])
        );
    }

    public function render()
    {
        return view('livewire..admin.overview')
            ->layout('components.layouts.admin', [
                'page' => self::page()
            ]);
    }
}
