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
}
