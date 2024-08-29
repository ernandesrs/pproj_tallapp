<x-admin.page
    title="Editar cargo">

    <x-slot:actions>
        @can([\App\Enums\Roles\Permissions\RolePermissionsEnum::CREATE->value])
            <x-button wire:navigate href="{{ route('admin.roles.create') }}" color="emerald" icon="plus" position="left">
                Novo cargo
            </x-button>
        @endcan
    </x-slot:actions>

    <div class="col-span-12 grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <x-input wire:model="name" label="Name do cargo *" />
        </div>
        <div class="col-span-12">
        </div>
    </div>

</x-admin.page>
