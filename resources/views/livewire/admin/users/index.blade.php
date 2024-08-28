<x-admin.page
    title="Usuários">

    <x-slot:actions>
        @can([\App\Enums\Roles\Permissions\UserPermissionsEnum::CREATE->value])
            <x-button wire:navigate href="{{ route('admin.users.index') }}" color="emerald" icon="plus" position="left">
                Novo usuário
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12">
        <x-table :$headers :$rows filter :quantity="[5, 10, 15, 20]" paginate persistent loading>
            @interact('column_action', $row)
                @can(\App\Enums\Roles\Permissions\UserPermissionsEnum::UPDATE->value)
                    <x-button text="Editar" icon="edit" color="secondary" flat sm />
                @endcan
                @can(\App\Enums\Roles\Permissions\UserPermissionsEnum::DELETE->value)
                    <x-button wire:click="deleteItem({{ $row->id }})" text="Excluir" icon="trash" color="rose" flat
                        sm />
                @endcan
            @endinteract
        </x-table>
    </div>

</x-admin.page>
