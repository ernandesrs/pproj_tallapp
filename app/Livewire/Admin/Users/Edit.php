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

    #[Locked]
    public \Illuminate\Database\Eloquent\Collection $roles;

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
        $this->roles = $this->user->roles()->get();
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
     * Update user role
     * @param string $role valid role name
     * @return void
     */
    public function updateRole(string $role)
    {
        $this->authorize('updateUserRoles', $this->user);

        $validator = \Validator::make([
            'role' => $role
        ], [
            'role' => ['required', 'string', 'exists:roles,name']
        ]);

        if ($validator->fails()) {
            $this->toast()
                ->error('Erro!', 'O cargo informado é inválido.')
                ->flash()
                ->send();
            return $this->redirect(route('admin.users.edit', ['user' => $this->user->id]));
        }

        $roleName = $validator->validated()['role'];

        if ($this->user->hasRole($roleName)) {
            $this->user->removeRole($roleName);
            $this->toast()
                ->info('Removido!', 'Cargo atribuído a ' . $this->user->first_name . ' foi revogado com sucesso.')
                ->send();
        } else {
            $this->user->assignRole($roleName);
            $this->toast()
                ->success('Atribuído!', 'Novo cargo atribuído a ' . $this->user->first_name . ' com sucesso.')
                ->send();
        }
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
