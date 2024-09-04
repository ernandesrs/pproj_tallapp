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
    case UPDATE_ADMIN = 'update_admin';

    case DELETE = 'delete_user';
    case DELETE_ADMIN = 'delete_admin';

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
            static::VIEW_ANY => 'Ver todos usuários',
            static::VIEW => 'Ver um usuário',
            static::CREATE => 'Criar usuário',

            static::UPDATE => 'Editar usuário',
            static::UPDATE_ADMIN => 'Editar administrador',

            static::DELETE => 'Deletar usuário',
            static::DELETE_ADMIN => 'Deletar administrador',

            static::FORCE_DELETE => 'Exclusão forçada de usuário',
            static::DELETE_MANY => 'Deletar vários usuários',
            static::RESTORE => 'Restaurar usuário',
            static::EDIT_ROLE => 'Editar cargo do usuário',
        };
    }

    /**
     * Permissions label
     * @return string
     */
    function permissionsLabel(): string
    {
        return 'Permissões sobre usuários';
    }
}
