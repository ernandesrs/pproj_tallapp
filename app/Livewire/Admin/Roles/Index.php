<?php

namespace App\Livewire\Admin\Roles;

use App\Livewire\Admin\Traits\ListTrait;
use App\Models\Role;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use ListTrait, Interactions;

    /**
     * Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    static function model(): \Illuminate\Database\Eloquent\Model
    {
        return new Role();
    }

    /**
     * Searchable fields
     * @return string|null
     */
    static function searchables(): string|null
    {
        return 'name';
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..admin.roles.index', [
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['index' => 'name', 'label' => 'Nome'],
                ['index' => 'guard_name', 'label' => 'Guard'],
                ['index' => 'created_at', 'label' => 'Criado em'],
                ['index' => 'action', 'label' => 'Ações'],
            ],
            'rows' => $this->getItems(),
        ])
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Cargos'
                ]
            ]);
    }

    /**
     * Delete item confirmation
     * @param Role $role
     * @return void
     */
    public function deleteItem(Role $role)
    {
        $this->dialog()
            ->warning('Excluir cargo?', 'Você está excluindo o cargo ' . $role->name . ' e isso não pode ser desfeito, confirme para continuar.')
            ->cancel('Cancelar')
            ->confirm('Confirmar', 'deleteItemConfirmed', ['role' => $role->id])
            ->send();
    }

    /**
     * Delete item confirmed
     * @param \App\Models\Role $role
     * @return void
     */
    public function deleteItemConfirmed(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        $this->toast()
            ->info('Excluído!', 'Cargo excluído com sucesso!')
            ->send();
    }
}
