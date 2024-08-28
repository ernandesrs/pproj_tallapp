<?php

namespace App\Interfaces;

interface ServicesInterface
{
    /**
     * Create a new model
     * @param array $validated validated data
     * @param array $options something, like a flag, a sign, to be used by you in implementing the method
     * @return null|\Illuminate\Database\Eloquent\Model return the created model or null on fail
     */
    public static function create(array $validated, array $options = []): null|\Illuminate\Database\Eloquent\Model;

    /**
     * Update a model
     * @param array $validated validated data
     * @param \Illuminate\Database\Eloquent\Model $model the model to update
     * @param array $options something, like a flag, a sign, to be used by you in implementing the method
     * @return null|\Illuminate\Database\Eloquent\Model return the updated model or null on fail
     */
    public static function update(array $validated, \Illuminate\Database\Eloquent\Model $model, array $options = []): null|\Illuminate\Database\Eloquent\Model;

    /**
     * Delete a model
     * @param \Illuminate\Database\Eloquent\Model $model model to delete
     * @param array $options something, like a flag, a sign, to be used by you in implementing the method
     * @return bool
     */
    public static function delete(\Illuminate\Database\Eloquent\Model $model, array $options = []): bool;

    /**
     * Creation and update rules
     * @return \App\Interfaces\RulesInterface a class instance implementing App\Interfaces\RulesInterface
     */
    public static function rules(): \App\Interfaces\RulesInterface;
}
