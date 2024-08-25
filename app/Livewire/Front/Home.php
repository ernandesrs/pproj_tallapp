<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire..front.home')
            ->layout('components.layouts.front', [
                'seo' => (object) [
                    'title' => 'Tall App Home',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint sed soluta aliquid sit eos.'
                ]
            ]);

    }
}
