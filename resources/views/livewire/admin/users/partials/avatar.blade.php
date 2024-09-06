@props([
    'row' => null,
    'model' => null,
])

@php
    $model = $row ?? $model;

    throw_if(is_null($model), 'Requires a model via prop "row" or "model"');
@endphp

<x-admin.custom-avatar :avatar="$model->avatar" text="{{ $model->first_name }}" />
