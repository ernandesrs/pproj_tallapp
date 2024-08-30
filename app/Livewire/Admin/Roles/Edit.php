<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use App\Services\RoleService;
use Livewire\Attributes\Locked;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{
    use Interactions;

    /**
     * Role
     * @var Role
     */
    #[Locked]
    public Role $role;

    public string $name;

    public string $display_name = '';

    public null|string $description = '';

    /**
     * Mount
     * @param \App\Models\Role $role
     * @return void
     */
    public function mount(Role $role)
    {
        $this->role = $role;
        $this->fill($this->role->only([
            'name',
            'display_name',
            'description',
        ]));
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        return view('livewire..admin.roles.edit')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Editar cargo'
                ]
            ]);
    }

    /**
     * Update a role
     * @return void
     */
    public function update()
    {
        $this->authorize('update', $this->role);

        RoleService::update(
            $this->validate(RoleService::rules()::updateRules($this->role)),
            $this->role
        );

        $this->toast()
            ->success('Atualizado!', 'Função atualizada com sucesso.')
            ->send();
    }

    /**
     * Assign or revoke permission
     * @param string $name
     * @return void
     */
    public function assignOrRevokePermission(string $name)
    {
        $this->authorize('update', $this->role);

        $validator = \Validator::make(
            [
                'permission' => $name
            ],
            RoleService::rules()::rolePermissionRules()
        );

        if ($validator->fails()) {
            $this->toast()
                ->error('Erro!', 'Permissão inválida.')
                ->flash()
                ->send();

            return $this->redirect(route('admin.roles.edit', ['role' => $this->role->id]));
        }

        if ($this->role->hasPermissionTo($name)) {
            $this->role->revokePermissionTo($name);
            $this->toast()
                ->info('Revogada!', 'Permissão revogada para ' . $this->role->name)
                ->send();
        } else {
            $this->role->givePermissionTo($name);
            $this->toast()
                ->info('Atribuída!', 'Permissão atribuída para ' . $this->role->name)
                ->send();
        }
    }
}
