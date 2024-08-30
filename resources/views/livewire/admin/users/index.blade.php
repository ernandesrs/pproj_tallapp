<x-admin.page
    title="Usuários">

    <x-slot:actions>
        @can('create', \App\Models\User::class)
            <x-button wire:navigate href="{{ route('admin.users.create') }}" color="emerald" icon="plus" position="left">
                Novo usuário
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12">
        <x-table :$headers :$rows filter :quantity="[5, 10, 15, 20]" paginate persistent loading>
            @interact('column_action', $row)
                @can('update', $row)
                    <x-button wire:navigate href="{{ route('admin.users.edit', ['user' => $row->id]) }}" text="Editar"
                        icon="edit"
                        color="primary" flat sm />
                @endcan
                @can('delete', $row)
                    <x-button wire:click="deleteItem({{ $row->id }})" text="Excluir" icon="trash" color="rose" flat
                        sm />
                @endcan
            @endinteract
        </x-table>
    </div>

</x-admin.page>
