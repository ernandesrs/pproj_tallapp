<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    /**
     * Avaiable permissions
     * @param bool $unnamedKey
     * @return \Illuminate\Support\Collection
     */
    static function avaiablePermissions(bool $unnamedKey = false): Collection
    {
        $permissions = Collection::make([]);
        $namespaceBase = '\App\Enums\Roles\Permissions';
        $basePath = app_path('\Enums\Roles\Permissions');

        Collection::make(\File::allFiles($basePath))->map(function ($v, $k) use ($namespaceBase, &$permissions, $unnamedKey) {
            $enumClass = $namespaceBase . (empty($v->getRelativePath()) ? '' : '\\') . $v->getRelativePath() . '\\' . $v->getFilenameWithoutExtension();
            if (!$unnamedKey) {
                $permissions->put($enumClass, $enumClass::cases());
            } else {
                $permissions->push($enumClass::cases());
            }
        });

        return $permissions;
    }
}
