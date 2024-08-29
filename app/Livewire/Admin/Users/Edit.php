<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Services\UserService;
use Livewire\Attributes\Locked;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{
    use Interactions;

    #[Locked]
    public User $user;

    public string $first_name = '';

    public string $last_name = '';

    public string $username = '';

    public string $email = '';

    public string $gender = '';

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /**
     * Mount
     * @param \App\Models\User $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user;
        $this->fill($this->user->only(['first_name', 'last_name', 'username', 'email', 'gender']));
    }

    /**
     * Render view
     * @return mixed
     */
    public function render()
    {
        $this->authorize('update', $this->user);

        return view('livewire..admin.users.edit')
            ->layout('components.layouts.admin', [
                'seo' => (object) [
                    'title' => 'Editar usuário'
                ]
            ]);
    }

    /**
     * Update user
     * @return void
     */
    public function update()
    {
        $this->authorize('update', $this->user);

        $updated = UserService::update(
            $this->validate(UserService::rules()::updateRules($this->user)),
            $this->user
        );

        if (!$updated) {
            return;
        }

        $this->toast()
            ->info('Atualizado!', 'Os dados de perfil do usuário foram atualizados!')
            ->send();
    }

    /**
     * Delete avatar confirmation
     * @return void
     */
    public function deleteAvatar()
    {
        $this->dialog()
            ->warning('Tem certeza?', 'Confirme a exclusão do avatar deste usuário.')
            ->cancel('Cancelar')
            ->confirm('Excluir avatar', 'deleteAvatarConfirmed')
            ->send();
    }

    /**
     * Delete avatar after confirmation
     * @return void
     */
    public function deleteAvatarConfirmed()
    {
        $this->authorize('update', $this->user);

        UserService::deleteAvatar($this->user);

        $this->toast()
            ->info('Pronto!', 'Avatar excluído com sucesso')
            ->send();
    }
}
