<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Admin\Traits\ListTrait;
use App\Models\User;
use App\Services\UserService;
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
        return new User();
    }

    /**
     * Searchable fields
     * @return null|string
     */
    static function searchables(): null|string
    {
        return 'first_name,last_name,username,email';
    }

    static public function filterSelects(): array
    {
        return [
            [
                'index' => 'gender',
                'label' => 'Gênero',
                'options' => [
                    ['label' => 'Não definido', 'value' => 'n'],
                    ['label' => 'Feminino', 'value' => 'f'],
                    ['label' => 'Masculino', 'value' => 'm'],
                ]
            ]
        ];
    }

    static public function filterPeriods(): array
    {
        return [
            [
                'index' => 'created_at',
                'label' => 'Data de registro',
            ]
        ];
    }

    /**
     * Mount
     * @return void
     */
    public function mount()
    {
        $this->simpleList = false;
    }

    /**
     * Render
     * @return void
     */
    public function render()
    {
        $this->authorize('viewAny', User::class);

        $page = new \App\Builders\Page\Page(
            'Usuários',
            \App\Builders\Page\Breadcrumb
                ::make('admin.overview')
                ->add('Usuários', ['name' => 'admin.users.index'])
        );

        return view('livewire..admin.users.index', [
            'page' => $page,
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['view' => 'livewire.admin.users.partials.avatar', 'label' => 'Avatar'],
                ['view' => 'livewire.admin.users.partials.detail', 'label' => 'Usuário'],
                ['view' => 'livewire.admin.users.partials.roles', 'label' => 'Cargos'],
                ['index' => 'action', 'label' => 'Ações']
            ],
            'rows' => $this->getItems()
        ])->layout('components.layouts.admin', [
                    'page' => $page
                ]);
    }

    /**
     * Delete item
     * @param int $id
     * @return void
     */
    public function deleteItem(int $id): void
    {
        $user = User::where('id', $id)->firstOrFail(['id', 'first_name', 'last_name']);

        $this->authorize('delete', $user);

        if (!UserService::delete($user)) {
            $this->toast()
                ->error('Falha!', 'O usuário não pode ser excluido!')
                ->send();
            return;
        }

        $this->toast()
            ->info('Excluído!', 'O usuário foi excluído com sucesso!')
            ->send();
    }
}
