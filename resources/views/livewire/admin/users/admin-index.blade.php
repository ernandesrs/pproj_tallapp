<x-admin.page
    title="Administradores">

    <x-slot:actions>
        @can('viewAny', \App\Models\User::class)
            <x-button wire:navigate href="{{ route('admin.users.index') }}" color="emerald" icon="users-group" position="left">
                Ir para usuários
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12">
        <x-alert icon="info-circle"
            text="Qualquer usuário com um cargo atribuído é considerado um administrador, controle as permissões pelo cargo atribuído ao usuário."
            color="primary" light />
    </div>
    <div class="col-span-12">
        <x-admin.list-table
            :headers="$headers"
            :rows="$rows"
            :action-edit="fn($row) => route('admin.users.edit', ['user' => $row->id])"
            action-delete />
    </div>

</x-admin.page>
