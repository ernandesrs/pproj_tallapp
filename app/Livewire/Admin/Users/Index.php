<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination, Interactions;

    public ?int $quantity = 5;

    public ?string $search = null;

    public ?int $page = 2;

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
            'rows' => User::query()->when($this->search, function (Builder $query) {
                return $query->whereRaw('MATCH(first_name,last_name,username,email) AGAINST(? IN BOOLEAN MODE)', $this->search);
            })->offset($this->page)->paginate($this->quantity)
                ->withQueryString(),
            'type' => 'data'
        ])
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Usuários'
                ]
            ]);
    }

    /**
     * Delete item
     * @param \App\Models\User $user
     * @return void
     */
    public function deleteItem(User $user)
    {
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
