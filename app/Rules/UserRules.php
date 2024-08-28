<?php

namespace App\Rules;
use App\Rules\Interfaces\RulesInterface;

class UserRules implements RulesInterface
{
    /**
     * User creation rules
     * @return array
     */
    static public function creationRules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:25'],
            'last_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:25', 'unique:users,username'],
            'gender' => ['required', 'string', \Illuminate\Validation\Rule::in(['n', 'f', 'm'])],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }

    /**
     * User udpate rules
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    static public function updateRules(\Illuminate\Database\Eloquent\Model $model): array
    {
        $rules = self::creationRules();

        $rules['username'] = ['required', 'string', 'max:25', 'unique:users,username,' . $model->id];
        $rules['password'] = ['nullable', 'string', 'confirmed'];

        return $rules;
    }

    /**
     * Avatar update rules
     * @return array
     */
    static public function avatarUpdateRules(): array
    {
        return [
            'avatar' => ['required', 'mimes:png,jpg,jpeg', 'max:1024']
        ];
    }
}
