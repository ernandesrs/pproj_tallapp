<?php

namespace App\Enums\Roles\Permissions;

/**
 *
 * Defining permissions required for \App\Model\Role management
 *
 */
enum RolePermissionsEnum: string
{
    case VIEW_ANY = 'view_any_roles';

    case VIEW = 'view_role';

    case CREATE = 'create_role';

    case UPDATE = 'update_role';

    case DELETE = 'delete_role';

    case DELETE_MANY = 'delete_many_roles';

    /**
     * Role permission label
     * @return string
     */
    function label(): string
    {
        return match ($this) {
            static::VIEW_ANY => 'View any roles',
            static::VIEW => 'View role',
            static::CREATE => 'Create role',
            static::UPDATE => 'Edit role',
            static::DELETE => 'Delete role',
            static::DELETE_MANY => 'Delete many roles',
        };
    }
}
