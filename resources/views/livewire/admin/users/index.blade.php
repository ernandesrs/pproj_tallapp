<x-admin.page
    :page="$page">

    <x-slot:actions>
        @can('create', \App\Models\User::class)
            <x-button wire:navigate href="{{ route('admin.users.create') }}" color="emerald" icon="plus" position="left">
                Novo usuário
            </x-button>
        @endcan
    </x-slot>

    <div class="col-span-12">
        <x-admin.list-table
            :headers="$headers"
            :rows="$rows"
            :action-edit="fn($row) => route('admin.users.edit', ['user' => $row->id])"
            action-delete />
    </div>

</x-admin.page>
