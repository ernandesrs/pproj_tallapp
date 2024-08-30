<?php

namespace App\Rules;
use App\Interfaces\RulesInterface;
use Illuminate\Validation\Rule;

class RoleRules implements RulesInterface
{
    /**
     * Rules do create role
     * @return array
     */
    static public function creationRules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name']
        ];
    }

    /**
     * Rules to update role
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    static public function updateRules(\Illuminate\Database\Eloquent\Model $model): array
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name,' . $model->id]
        ];
    }

    /**
     * Role permissions rules
     * @return array
     */
    static public function rolePermissionRules(): array
    {
        $permissions = collect();

        \App\Models\Permission::avaiablePermissions()->map(function ($group) use ($permissions) {
            return collect($group)->map(function ($permission) use ($permissions) {
                $permissions->push($permission->value);
            });
        });

        return [
            'permission' => ['required', 'string', Rule::in($permissions->toArray())]
        ];
    }
}
