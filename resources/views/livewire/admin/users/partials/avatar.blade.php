@props([
    'row' => null,
    'model' => null,
])

@php
    $model = $row ?? $model;

    throw_if(is_null($model), 'Requires a model via prop "row" or "model"');
@endphp

<x-avatar
    image="{{ $model->avatar ? (\Str::startsWith($model->avatar, ['https://', 'http://']) ? $model->avatar : \Storage::url($model->avatar)) : null }}"
    text="{{ $model->first_name }}" sm />
