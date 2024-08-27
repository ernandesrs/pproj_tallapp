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
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto architecto dolores ea magni eaque quos earum
        commodi eum! Accusamus debitis adipisci dolores deserunt itaque corrupti neque ab ullam obcaecati at.
    </div>

</x-admin.page>
