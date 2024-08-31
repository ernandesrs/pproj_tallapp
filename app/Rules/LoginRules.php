<?php

namespace App\Rules;

use App\Interfaces\RulesInterface;

class LoginRules implements RulesInterface
{
    /**
     * Rules do login data
     * @return array
     */
    static function loginRules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean']
        ];
    }

    // Ignore
    static function creationRules(): array
    {
        return [];
    }

    // Ignore
    static function updateRules(\Illuminate\Database\Eloquent\Model $model): array
    {
        return [];
    }
}
