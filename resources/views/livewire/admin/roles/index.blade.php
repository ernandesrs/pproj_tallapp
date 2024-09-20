<x-admin.page
    :page="$page">

    <x-slot:actions>
        @can('create', \App\Models\Role::class)
            <x-button wire:navigate href="{{ route('admin.roles.create') }}" color="emerald" icon="plus" position="left">
                Novo cargo
            </x-button>
        @endcan
    </x-slot:actions>

    <div class="col-span-12">
        <x-admin.list-table
            :headers="$headers"
            :rows="$rows"
            :action-edit="fn($row) => route('admin.roles.edit', ['role' => $row->id])"
            action-delete />
    </div>

</x-admin.page>
