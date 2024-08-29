<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
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

    /**
     * Mount
     * @param \App\Models\Role $role
     * @return void
     */
    public function mount(Role $role)
    {
        $this->role = $role;
        $this->fill($this->role->only([
            'name'
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
}
