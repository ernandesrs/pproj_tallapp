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
        <div class="col-span-12 md:col-span-4 grid grid-cols-12 gap-6">
            <x-admin.content-card
                title="Avatar"
                class="col-span-12">
            </x-admin.content-card>

            <x-admin.content-card
                title="Detalhes gerais"
                class="col-span-12">
            </x-admin.content-card>

            <x-admin.content-card
                title="Cargos"
                class="col-span-12">
            </x-admin.content-card>

            <x-admin.content-card
                title="Conta"
                class="col-span-12">
            </x-admin.content-card>
        </div>

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
    </div>

</x-admin.page>
