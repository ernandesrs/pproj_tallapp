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
            static::VIEW_ANY => 'Ver todos',
            static::VIEW => 'Ver um',
            static::CREATE => 'Criar',
            static::UPDATE => 'Editar',
            static::DELETE => 'Deletar',
            static::FORCE_DELETE => 'Exclusão forçada',
            static::DELETE_MANY => 'Deletar vários',
            static::RESTORE => 'Restaurar',
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
