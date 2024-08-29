<x-admin.page
    title="Editar usuário">

    <x-slot:actions>
        @can([\App\Enums\Roles\Permissions\UserPermissionsEnum::CREATE->value])
            <x-button wire:navigate href="{{ route('admin.users.create') }}" color="emerald" icon="plus" position="left">
                Novo usuário
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12 grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-8 grid grid-cols-12 gap-6">
            <x-admin.content-card
                title="Dados básicos"
                class="col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    @include('livewire.admin.users.partials.basic-data-fields', ['edit' => true])
                    <div class="col-span-12 flex justify-center">
                        <x-button wire:target="update" wire:click="update" text="Atualizar usuário" icon="user-check"
                            loading />
                    </div>
                </div>
            </x-admin.content-card>
        </div>

        <div class="col-span-12 md:col-span-4 grid grid-cols-12 gap-6">
            <x-admin.content-card
                title="Avatar"
                class="col-span-12">
                <div class="flex justify-center items-center gap-6">
                    <div>
                        @if ($user->avatar)
                            <x-avatar
                                image="{{ \Str::startsWith($user->avatar, ['http://', 'https://']) ? $user->avatar : \Storage::url($user->avatar) }}"
                                lg />
                        @else
                            <x-avatar text="{{ $user->first_name }}" lg />
                        @endif
                    </div>

                    @if ($user->avatar)
                        <x-button wire:target="deleteAvatar" wire:click="deleteAvatar" text="Excluir" color="rose"
                            icon="trash" sm />
                    @endif
                </div>
            </x-admin.content-card>

            <x-admin.content-card
                title="Detalhes gerais"
                class="col-span-12">

                <div class="flex items-center gap-6">
                    <div class="flex-1 font-medium">
                        Verificado em:
                    </div>
                    <div class="flex-1">
                        {{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Não verificado' }}
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 font-medium">
                        Criado em:
                    </div>
                    <div class="flex-1">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 font-medium">
                        Cargos:
                    </div>
                    <div class="flex-1 flex flex-wrap items-center gap-5">
                        @foreach ($roles as $role)
                            <x-badge text="{{ $role->name }}" outline xs />
                        @endforeach
                    </div>
                </div>

                <div class="flex mt-2">
                    <x-link href="#" text="Atribuir cargos" icon="user-shield"
                        x-on:click.prevent="$modalOpen('edit-user-roles-modal')" />

                    {{-- edit roles modal --}}
                    <x-modal title="Cargos do {{ $user->first_name }} {{ $user->last_name }}" id="edit-user-roles-modal"
                        size="3xl" z-index="z-40" persistent center>
                        <div class="flex flex-wrap gap-3">
                            @foreach (\App\Models\Role::avaiableRoles() as $aRole)
                                @php
                                    $hasRole = $user->hasRole($aRole);
                                @endphp
                                <x-button wire:click="updateRole('{{ $aRole->value }}')"
                                    text="{{ $aRole->label() }}"
                                    :color="$hasRole ? 'emerald' : 'gray'"
                                    :flat="!$hasRole"
                                    :icon="$hasRole ? 'check' : 'plus'" />
                            @endforeach
                        </div>
                    </x-modal>
                    {{-- /edit roles modal --}}
                </div>

            </x-admin.content-card>
        </div>
    </div>

</x-admin.page>
