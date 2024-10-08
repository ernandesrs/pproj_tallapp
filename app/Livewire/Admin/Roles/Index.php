<?php

namespace App\Livewire\Admin\Roles;

use App\Livewire\Admin\Traits\ListTrait;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use ListTrait, Interactions;

    /**
     * Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    static function model(): Model
    {
        return new Role();
    }

    /**
     * Searchable fields
     * @return string|null
     */
    static function searchables(): string|null
    {
        return 'name,display_name';
    }

    static public function filterSelects(): array
    {
        return [];
    }

    static public function filterPeriods(): array
    {
        return [
            [
                'index' => 'created_at',
                'label' => 'Data de registro'
            ]
        ];
    }

    /**
     * Mount
     * @return void
     */
    public function mount()
    {
        $this->simpleList = true;
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        $this->authorize('viewAny', Role::class);

        $page = new \App\Builders\Page\Page(
            'Cargos',
            \App\Builders\Page\Breadcrumb::make('admin.overview')
                ->add('Cargos', ['name' => 'admin.roles.index'])
        );

        return view('livewire..admin.roles.index', [
            'page' => $page,
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['index' => 'display_name', 'label' => 'Nome'],
                ['index' => 'created_at', 'label' => 'Criado em'],
                ['index' => 'action', 'label' => 'Ações'],
            ],
            'rows' => $this->getItems(),
        ])
            ->layout('components.layouts.admin', [
                'page' => $page
            ]);
    }

    /**
     * Delete item confirmation
     * @param int $id
     * @return void
     */
    public function deleteItem(int $id): void
    {
        $role = Role::where('id', $id)->firstOrFail(['id', 'name']);

        $this->authorize('delete', $role);

        $role->delete();

        $this->toast()
            ->info('Excluído!', 'Cargo excluído com sucesso!')
            ->send();
    }
}
