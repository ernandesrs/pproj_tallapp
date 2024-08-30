<x-admin.page
    title="Novo cargo">

    <x-admin.content-card class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            @include('livewire.admin.roles.partials.role-fields', ['role' => null])

            <div class="col-span-12 flex justify-center">
                <x-button wire:target="save" wire:click="save" text="Criar cargo" icon="check"
                    loading />
            </div>
        </div>
    </x-admin.content-card>

</x-admin.page>
