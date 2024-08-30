<?php

namespace App\Policies;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RolePolicy extends BasePolicy
{
    /**
     * Permissions enum class
     * @return string
     */
    static function permissionsEnumClass()
    {
        return \App\Enums\Roles\Permissions\RolePermissionsEnum::class;
    }

    /**
     * Check if provided rule is protected(All default rules is protected)
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    static function isProtectedRole(Model $model)
    {
        return Role::avaiableRoles()->first(fn($role) => $role->value == $model->name) ? true : false;
    }

    /**
     * Check if the current user can update a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        // can't edit role super user
        if ($model->name == \App\Enums\Roles\RoleEnum::SUPER->value) {
            return false;
        }

        return parent::update($user, $model);
    }

    /**
     * Check if the current user can delete a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        return self::isProtectedRole($model) ? false : parent::delete($user, $model);
    }

    /**
     * Check if the current user can force delete a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return self::isProtectedRole($model) ? false : parent::forceDelete($user, $model);
    }
}
