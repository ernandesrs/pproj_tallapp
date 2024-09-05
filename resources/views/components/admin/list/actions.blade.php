@if (isset($actionEdit) && !is_null($actionEdit))
    @can('update', $row)
        <x-button wire:navigate href="{{ $actionEdit($row) }}" text="Editar"
            icon="edit"
            color="primary" flat sm />
    @endcan
@endif

@if (isset($actionDelete) && !is_null($actionDelete))
    @can('delete', $row)
        <x-admin.delete-confirmation
            dialog-text="Você está excluindo o item com o <b>ID {{ $row->id }}</b> deste lista, confirme para continuar."
            :confirm-param="$row->id" flat sm />
    @endcan
@endif
