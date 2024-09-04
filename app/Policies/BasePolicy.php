<?php

namespace App\Policies;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class BasePolicy
{
    /**
     * Must return the permissions enum class to model
     * @return string
     */
    abstract static function permissionsEnumClass();

    /**
     * Check if the current user can view any specific models
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::VIEW_ANY->value);
    }

    /**
     * Check if the current user can view a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function view(User $user, Model $model): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::VIEW->value);
    }

    /**
     * Check if the current user can create a specific model
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::CREATE->value);
    }

    /**
     * Check if the current user can update a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::UPDATE->value);
    }

    /**
     * Check if the current user can delete a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::DELETE->value);
    }

    /**
     * Check if the current user can force delete a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function forceDelete(User $user, Model $model): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::FORCE_DELETE->value);
    }

    /**
     * Check if the current user can delete many a specific models
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function deleteMany(User $user, Model $model): bool
    {
        return false;
    }

    /**
     * Check if the current user can restore a specific model
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    public function restore(User $user, Model $model): bool
    {
        if ($this->isSuperUser($user)) {
            return true;
        }

        return $user->can(static::permissionsEnumClass()::RESTORE->value);
    }

    /**
     * Check if user is a super user
     * @param \Illuminate\Database\Eloquent\Model|\App\Models\User $user
     * @return bool
     */
    public function isSuperUser(Model|User $user)
    {
        return $user->hasRole(\App\Enums\Roles\RoleEnum::SUPER);
    }

    /**
     * Check if user is admin
     * @param \Illuminate\Database\Eloquent\Model|\App\Models\User $user
     * @return bool
     */
    public function isAdminUser(Model|User $user): bool
    {
        return $user->hasAnyRole(Role::all(['id']));
    }
}
