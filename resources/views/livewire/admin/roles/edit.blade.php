<x-admin.page
    title="Editar cargo">

    <x-slot:actions>
        @can('create', \App\Models\Role::class)
            <x-button wire:navigate href="{{ route('admin.roles.create') }}" color="emerald" icon="plus" position="left">
                Novo cargo
            </x-button>
        @endcan
    </x-slot:actions>

    <div class="col-span-12 lg:col-span-7 grid grid-cols-12 gap-6">
        <x-admin.content-card class="col-span-12">
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
            class="col-span-12">
            @if ($role->name == \App\Enums\Roles\RoleEnum::SUPER->value)
                <x-alert icon="lock-open"
                    text="Este cargo possui todas as permissões. Muito cuidado ao atribui-lo a um usuário."
                    color="secondary" outline />
            @else
                <div class="grid grid-cols-12 gap-6">
                    @foreach (\App\Models\Permission::avaiablePermissions() as $key => $group)
                        <div class="col-span-12 flex items-center gap-2">
                            <div><x-icon name="arrow-right" class="w-8" /></div>
                            <div class="w-full text-base md:text-lg truncate">{{ $group[0]->permissionsLabel() }}</div>
                        </div>
                        <div class="col-span-12 flex flex-wrap gap-6">
                            @foreach ($group as $permission)
                                @php
                                    $hasPermission = $role->hasPermissionTo($permission);
                                @endphp
                                <x-button
                                    wire:click="assignOrRevokePermission('{{ $permission->value }}')"
                                    text="{{ $permission->label() }}"
                                    :color="$hasPermission ? 'emerald' : 'light'"
                                    :outline="!$hasPermission"
                                    :icon="$hasPermission ? 'check' : 'plus'"
                                    sm />
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif

        </x-admin.content-card>
    </div>

    <div class="col-span-12 lg:col-span-5 grid grid-cols-12 gap-6">
        <x-admin.content-card title="Usuários" subtitle="Usuários que possuem este cargo" class="col-span-12">
            @php
                $users = $role->users()->limit(10)->get();
            @endphp
            <x-table :headers="[
                ['index' => 'username', 'label' => 'Usuário'],
                ['index' => 'email', 'label' => 'E-mail'],
                ['index' => 'action'],
            ]" :rows="$users" headerless>
                @interact('column_action', $row)
                    @can('update', $row)
                        <x-button wire:navigate href="{{ route('admin.users.edit', ['user' => $row->id]) }}" icon="edit"
                            color="primary"
                            title="Editar usuário" sm />
                    @endcan

                    @can('updateUserRoles', $row)
                        <x-button

                            x-data="{
                                userId: {{ $row->id }},
                                title: 'Revogar cargo do usuário {{ $row->email }}?',
                                revokeRole() {
                                    $interaction('dialog')
                                        .wireable()
                                        .warning(this.title)
                                        .confirm('Revogar', 'revokeRoleFromUser', this.userId)
                                        .cancel('Cancelar')
                                        .send();
                                }
                            }"
                            x-on:click="revokeRole"
                            icon="user-down" color="rose" title="Revogar cargo" sm />
                    @endcan
                @endinteract
            </x-table>
        </x-admin.content-card>
    </div>

</x-admin.page>
