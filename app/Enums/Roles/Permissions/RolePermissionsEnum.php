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
            static::VIEW_ANY => 'Ver todos cargos',
            static::VIEW => 'Ver um cargo',
            static::CREATE => 'Criar cargo',
            static::UPDATE => 'Editar cargo',
            static::DELETE => 'Deletar cargo',
            static::DELETE_MANY => 'Deletar vários cargos',
        };
    }

    /**
     * Permissions label
     * @return string
     */
    function permissionsLabel(): string
    {
        return 'Permissões sobre cargos';
    }
}
