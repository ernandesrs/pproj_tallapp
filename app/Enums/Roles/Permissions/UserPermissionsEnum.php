<?php

namespace App\Enums\Roles\Permissions;

/**
 *
 * Defining permissions required for \App\Model\User management
 *
 */
enum UserPermissionsEnum: string
{
    case VIEW_ANY = 'view_any_users';

    case VIEW = 'view_user';

    case CREATE = 'create_user';

    case UPDATE = 'update_user';

    case DELETE = 'delete_user';

    case DELETE_MANY = 'delete_many_users';

    case EDIT_ROLE = 'edit_user_roles';

    /**
     * User permission label
     * @return string
     */
    function label(): string
    {
        return match ($this) {
            static::VIEW_ANY => 'View any users',
            static::VIEW => 'View user',
            static::CREATE => 'Create user',
            static::UPDATE => 'Edit user',
            static::DELETE => 'Delete user',
            static::DELETE_MANY => 'Delete many users',
            static::EDIT_ROLE => 'Edit user roles',
        };
    }
}
