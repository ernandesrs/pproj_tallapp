<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get and registering permissions
        \App\Models\Permission::avaiablePermissions()->map(function ($permissionGroup) {
            Collection::make($permissionGroup)->map(function ($permission) {
                \App\Models\Permission::create([
                    'guard_name' => 'web',
                    'name' => $permission->value
                ]);
            });
        });

        // Get and registering roles
        \App\Models\Role::avaiableRoles()->map(function ($role) {
            $registeredRole = \App\Models\Role::create([
                'guard_name' => 'web',
                'name' => $role->value
            ]);

            // Giving permissions to registered role
            if ($registeredRole) {
                switch ($registeredRole->name) {
                    case \App\Enums\Roles\RoleEnum::SUPER->value:
                        // super have all permissions
                        $registeredRole->givePermissionTo(\App\Models\Permission::all());
                        break;
                    case \App\Enums\Roles\RoleEnum::ADMIN->value:
                        // admin have some permissions
                        $registeredRole->givePermissionTo([
                            \App\Enums\Roles\Permissions\UserPermissionsEnum::VIEW_ANY,
                            \App\Enums\Roles\Permissions\RolePermissionsEnum::VIEW_ANY,
                        ]);
                        break;
                }
            }
        });

    }
}
