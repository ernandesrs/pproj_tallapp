<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class UserPolicy extends BasePolicy
{
    /**
     * User permissions enum class
     * @return string
     */
    static function permissionsEnumClass()
    {
        return \App\Enums\Roles\Permissions\UserPermissionsEnum::class;
    }

    /**
     * Check if the current user can update a specific model
     *
     * Desc.:
     * * Nâo pode editar própria conta
     * * Super usuários pode editar super usuários
     * * Administradores ou qualquer cargo com permissão editar usuário, pode editar outros com mesmo cargo.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        if (!self::checkIfEditingYourselfAndIfModelIsSuper($user, $model)) {
            return false;
        }

        return parent::update($user, $model);
    }

    /**
     * Check if the current user can delete a specific model
     *
     * Desc:
     * * Não pode excluir própria conta;
     * * Super usuários pode excluir super usuários;
     * * Administradores ou qualquer cargo com permissão de exclusão de usuários, pode excluir outros com mesmo cargo,
     *   mas não pode excluir super usuários.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        if (!self::checkIfEditingYourselfAndIfModelIsSuper($user, $model)) {
            return false;
        }

        return parent::delete($user, $model);
    }

    /**
     * Check if the current user can force delete a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return parent::delete($user, $model);
    }

    /**
     * Check if the current user can update user roles
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function updateUserRoles(User $user, Model $model): bool
    {
        if (
            // cannot update your roles
            $user->id == $model->id
        ) {
            return false;
        }

        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::EDIT_ROLE->value);
    }

    /**
     * Check if editing yourself and if model is super user
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    private function checkIfEditingYourselfAndIfModelIsSuper(User $user, Model $model)
    {
        if (
            // can't edit yourself here
            $user->id == $model->id ||

                // only super users can edit super users
            (!$this->isSuperUser($user) && $this->isSuperUser($model))
        ) {
            return false;
        }

        return true;
    }
}
