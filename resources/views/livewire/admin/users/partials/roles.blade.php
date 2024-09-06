@props([
    'row' => null,
])

@php
    throw_if(is_null($row) || !($row instanceof (\Illuminate\Database\Eloquent\Model::class)), 'Requires a model instance via prop "row"');
@endphp

<div class="flex flex-wrap gap-2">
    @foreach ($row->roles()->get(['id', 'display_name']) as $role)
        <x-badge text="{{$role->display_name}}" xs />
    @endforeach
</div>
