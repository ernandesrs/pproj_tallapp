<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use App\Services\RoleService;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public string $name = '';

    public string $display_name = '';

    public null|string $description = '';

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        $this->authorize('create', Role::class);

        $page = new \App\Builders\Page\Page(
            'Novo cargo',
            \App\Builders\Page\Breadcrumb::make('admin.overview')
                ->add('Cargos', ['name' => 'admin.roles.index'])
                ->add('Criar', ['name' => 'admin.roles.create'])
        );

        return view('livewire..admin.roles.create', [
            'page' => $page
        ])->layout('components.layouts.admin', [
                    'page' => $page
                ]);
    }

    /**
     * Save role
     * @return void
     */
    public function save()
    {
        $this->authorize('create', Role::class);

        $created = RoleService::create(
            $this->validate(RoleService::rules()::creationRules())
        );

        if (!$created) {
            $this->toast()
                ->error('Erro!', 'Houve um erro inesperado ao tentar criar novo cargo.')
                ->send();
            return;
        }

        $this->toast()
            ->success('Criado!', 'Novo cargo criado com sucesso.')
            ->flash()
            ->send();

        return $this->redirect(route('admin.roles.edit', ['role' => $created->id]));
    }
}
