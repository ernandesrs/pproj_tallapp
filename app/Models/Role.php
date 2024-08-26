<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    /**
     * Avaiable roles
     * @return \Illuminate\Support\Collection
     */
    static function avaiableRoles(): Collection
    {
        return Collection::make(\App\Enums\Roles\RoleEnum::cases());
    }
}
