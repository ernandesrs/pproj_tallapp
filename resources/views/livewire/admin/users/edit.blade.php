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
                    <div class="flex-1">
                        @php
                            $roles = $user->roles();
                            $roleCount = $roles->count();

                            $roles = $roles->limit(3)->get();
                        @endphp

                        @foreach ($roles as $role)
                            <x-badge text="{{ $role->name }}" xs />
                        @endforeach

                    </div>
                </div>

            </x-admin.content-card>

            <x-admin.content-card
                title="Conta"
                class="col-span-12">
            </x-admin.content-card>
        </div>
    </div>

</x-admin.page>
