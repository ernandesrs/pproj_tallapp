@props([
    'actionEdit' => null,
    'actionDelete' => false,
    'headers' => null,
    'rows' => null,
])

@php
    throw_if(
        !is_null($actionEdit) && !is_callable($actionEdit),
        'actionEdit prop requires a callable returning a edit route.',
    );

    throw_if(!is_bool($actionDelete), 'actionDelete prop requires a boolean value');
@endphp

<x-table :$headers :$rows :quantity="[5, 10, 15, 20]" filter paginate persistent loading>
    @interact('column_action', $row, $actionEdit, $actionDelete)
        @if (isset($actionEdit) && !is_null($actionEdit))
            @can('update', $row)
                <x-button wire:navigate href="{{ $actionEdit($row) }}" text="Editar"
                    icon="edit"
                    color="primary" flat sm />
            @endcan
        @endif

        @if (isset($actionDelete) && !is_null($actionDelete))
            @can('delete', $row)
                <x-button wire:click="deleteItem({{ $row->id }})" text="Excluir" icon="trash" color="rose" flat
                    sm />
            @endcan
        @endif
    @endinteract
</x-table>
