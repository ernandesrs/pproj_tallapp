<x-admin.page
    title="Cargos">

    <x-slot:actions>
        @can([\App\Enums\Roles\Permissions\RolePermissionsEnum::CREATE->value])
            <x-button wire:navigate href="{{ route('admin.roles.create') }}" color="emerald" icon="plus" position="left">
                Novo cargo
            </x-button>
        @endcan
    </x-slot:actions>

</x-admin.page>
