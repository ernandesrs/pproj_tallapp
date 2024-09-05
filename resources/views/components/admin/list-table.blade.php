@props([
    'actionEdit' => null,
    'actionDelete' => false,
    'headers' => null,
    'rows' => null,
    'quantities' => [5, 10, 15, 20, 25],
])

@php
    throw_if(
        !is_null($actionEdit) && !is_callable($actionEdit),
        'actionEdit prop requires a callable returning a edit route.',
    );

    throw_if(!is_bool($actionDelete), 'actionDelete prop requires a boolean value');
@endphp

@if (!$this->simpleList)
    <x-admin.list.filter :$quantities />

    <x-admin.list.custom :$headers :$rows :action-edit="$actionEdit" :action-delete="$actionDelete" />
@else
    <x-table :$headers :$rows :quantity="[5, 10, 15, 20]" filter paginate persistent loading>
        @interact('column_action', $row, $actionEdit, $actionDelete)
            @include('components.admin.list.actions', [
                'actionEdit' => $actionEdit,
                'actionDelete' => $actionDelete,
            ])
        @endinteract
    </x-table>
@endif
