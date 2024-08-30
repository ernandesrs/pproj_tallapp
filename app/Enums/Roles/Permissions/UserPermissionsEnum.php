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

    case FORCE_DELETE = 'force_delete_user';

    case DELETE_MANY = 'delete_many_users';

    case RESTORE = 'restore_user';

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
            static::FORCE_DELETE => 'Force delete user',
            static::DELETE_MANY => 'Delete many users',
            static::RESTORE => 'Restore users',
            static::EDIT_ROLE => 'Edit user roles',
        };
    }
}
