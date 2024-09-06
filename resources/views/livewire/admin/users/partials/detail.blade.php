@props([
    'row' => null,
])

@php
    throw_if(is_null($row) || !($row instanceof (\Illuminate\Database\Eloquent\Model::class)), 'Requires a model instance via prop "row"');
@endphp

<div class="">
    <div class="text-zinc-600 dark:text-zinc-200">{{$row->first_name}} {{$row->last_name}}</div>
    <div class="text-zinc-400 text-sm dark:text-zinc-500">{{$row->email}}</div>
</div>
