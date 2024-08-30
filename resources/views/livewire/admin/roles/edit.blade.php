<x-admin.page
    title="Editar cargo">

    <x-slot:actions>
        @can('create', \App\Models\Role::class)
            <x-button wire:navigate href="{{ route('admin.roles.create') }}" color="emerald" icon="plus" position="left">
                Novo cargo
            </x-button>
        @endcan
    </x-slot:actions>

    <x-admin.content-card class="col-span-12 lg:col-span-4">
        <div class="grid grid-cols-12 gap-6">
            @include('livewire.admin.roles.partials.role-fields', ['role' => $role])

            <div class="col-span-12 flex justify-center">
                <x-button wire:target="update" wire:click="update" text="Atualizar cargo" icon="check"
                    loading />
            </div>
        </div>
    </x-admin.content-card>

    <x-admin.content-card
        title="Permissões deste cargo"
        class="col-span-12 lg:col-span-8">
        @if ($role->name == \App\Enums\Roles\RoleEnum::SUPER->value)
            <x-alert icon="info-square-rounded" title="Boa!" text="Este cargo possui todas as permissões."
                color="secondary" outline />
        @else
            <div class="grid grid-cols-12 gap-6">
                @foreach (\App\Models\Permission::avaiablePermissions() as $key => $group)
                    <div class="col-span-12 flex items-center gap-3">
                        <div><x-icon name="arrow-right" /></div>
                        <div class="w-full text-base md:text-lg truncate">{{ $key }}</div>
                    </div>
                    <div class="col-span-12 flex flex-wrap gap-6">
                        @foreach ($group as $permission)
                            @php
                                $hasPermission = $role->hasPermissionTo($permission);
                            @endphp
                            <x-button
                                wire:click="assignOrRevokePermission('{{ $permission->value }}')"
                                text="{{ $permission->label() }}"
                                :color="$hasPermission ? 'emerald' : 'gray'"
                                :flat="!$hasPermission"
                                :icon="$hasPermission ? 'check' : 'plus'"
                                sm />
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

    </x-admin.content-card>

</x-admin.page>
