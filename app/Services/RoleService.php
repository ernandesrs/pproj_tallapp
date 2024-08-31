<?php

namespace App\Services;
use App\Interfaces\ServicesInterface;
use App\Models\Role;
use App\Rules\RoleRules;

class RoleService implements ServicesInterface
{
    /**
     * Create role
     * @param array $validated
     * @param array $options
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    static function create(array $validated, array $options = []): \Illuminate\Database\Eloquent\Model|null
    {
        $created = Role::create($validated);
        if (!$created) {
            return null;
        }

        return $created;
    }

    /**
     * Update a role
     * @param array $validated
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $options
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    static function update(array $validated, \Illuminate\Database\Eloquent\Model $model, array $options = []): \Illuminate\Database\Eloquent\Model|null
    {
        if (!$model->update($validated)) {
            return null;
        }
        return $model->fresh();
    }

    /**
     * Delete a model
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $options
     * @return bool
     */
    static function delete(\Illuminate\Database\Eloquent\Model $model, array $options = []): bool
    {
        return $model->delete();
    }

    /**
     * Role rules
     * @return \App\Rules\RoleRules
     */
    static function rules(): RoleRules
    {
        return new RoleRules();
    }
}
