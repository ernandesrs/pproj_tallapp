<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Admin\Traits\ListTrait;
use App\Models\User;
use App\Services\UserService;
use App\Traits\Pages\PageTrait;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class AdminIndex extends Component
{
    use PageTrait, ListTrait, Interactions;

    /**
     * Page
     * @param mixed $model
     * @return \App\Builders\Page\Page
     */
    static function page(mixed $model = null): \App\Builders\Page\Page
    {
        return new \App\Builders\Page\Page(
            'Administradores',
            \App\Builders\Page\Breadcrumb
                ::make('admin.overview')
                ->add('Administradores', ['name' => 'admin.users.index']),
            'Listando apenas administradores'
        );
    }

    /**
     * Delete admin
     * @param int $id
     * @return void
     */
    public function deleteItem(int $id): void
    {
        $user = User::where('id', $id)->firstOrFail(['id', 'first_name', 'last_name']);

        $this->authorize('deleteAdmin', $user);

        if (!UserService::delete($user)) {
            $this->toast()
                ->error('Falha!', 'O administrador não pode ser excluido!')
                ->send();
            return;
        }

        $this->toast()
            ->info('Excluído!', 'O administrador foi excluído com sucesso!')
            ->send();
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
        ])->layout('components.layouts.admin', [
                    'page' => self::page()
                ]);
    }
}
