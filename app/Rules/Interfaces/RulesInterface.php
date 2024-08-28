<?php

namespace App\Rules\Interfaces;

interface RulesInterface
{
    /**
     * Rules to create
     * @return array
     */
    static public function creationRules(): array;

    /**
     * Rules do update
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    static public function updateRules(\Illuminate\Database\Eloquent\Model $model): array;
}
