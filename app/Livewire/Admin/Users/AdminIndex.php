<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Admin\Traits\ListTrait;
use App\Models\User;
use Livewire\Component;

class AdminIndex extends Component
{
    use ListTrait;

    function deleteItem(int $id): void
    {
        return;
    }

    static function model(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return (new User())->whereHas('roles');
    }

    static function searchables(): string|null
    {
        return 'first_name,last_name,username,email';
    }

    static function filterPeriods(): array
    {
        return [];
    }

    static function filterSelects(): array
    {
        return [
            [
                'index' => 'gender',
                'label' => 'Gênero',
                'options' => [
                    ['label' => 'Não definino', 'value' => 'n'],
                    ['label' => 'Feminino', 'value' => 'f'],
                    ['label' => 'Masculino', 'value' => 'm'],
                ]
            ]
        ];
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        $this->authorize('viewAny', User::class);

        return view('livewire..admin.users.admin-index', [
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['view' => 'livewire.admin.users.partials.avatar', 'label' => 'Avatar'],
                ['view' => 'livewire.admin.users.partials.detail', 'label' => 'Usuário'],
                ['view' => 'livewire.admin.users.partials.roles', 'label' => 'Cargos'],
                ['index' => 'action', 'label' => 'Ações']
            ],
            'rows' => $this->getItems()
        ])
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Administradores'
                ]
            ]);
    }
}
