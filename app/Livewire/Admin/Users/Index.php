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
    static function model(): \Illuminate\Database\Eloquent\Model
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

    /**
     * Render
     * @return void
     */
    public function render()
    {
        $this->authorize('viewAny', User::class);

        return view('livewire..admin.users.index', [
            'headers' => [
                ['index' => 'id', 'label' => 'ID'],
                ['index' => 'first_name', 'label' => 'Nome'],
                ['index' => 'last_name', 'label' => 'Sobrenome'],
                ['index' => 'email', 'label' => 'E-mail'],
                ['index' => 'action', 'label' => 'Ações']
            ],
            'rows' => $this->getItems()
        ])
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Usuários'
                ]
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

        $this->dialog()
            ->warning('Tem certeza?', 'Você está excluindo o usuário ' . $user->first_name . ' ' . $user->last_name . ', confirme para continuar.')
            ->cancel('Cancelar')
            ->confirm('Confirmar', 'deleteConfirmed', [
                'user' => $user->id
            ])
            ->send();
    }

    /**
     * Delete confirmed
     * @param \App\Models\User $user
     * @return void
     */
    public function deleteConfirmed(User $user)
    {
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
