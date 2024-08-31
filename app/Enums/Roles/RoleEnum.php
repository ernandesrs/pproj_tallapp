<?php

namespace App\Enums\Roles;

/**
 *
 * Definition of application roles.
 * All roles defined here will be considered protected and cannot be deleted.
 *
 */
enum RoleEnum: string
{
    case SUPER = 'super';

    case ADMIN = 'admin';

    /**
     * Role label
     * @return string
     */
    function label(): string
    {
        return match ($this) {
            static::SUPER => 'Super user',
            static::ADMIN => 'Administrator',
        };
    }

    /**
     * Role description
     * @return string
     */
    function description(): string
    {
        return match ($this) {
            static::SUPER => 'Este cargo deve ser atribuído apenas a proprietários do sistema, pois ele possui todas as permissões, SEM RESTRIÇÕES!',
            static::ADMIN => 'Este cargo deve ser atribuído a administradores. Verifique com atenção as permissões deste cargo.',
        };
    }
}
