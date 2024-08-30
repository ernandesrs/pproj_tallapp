<x-admin.page
    title="Novo cargo">

    <x-admin.content-card class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <x-input wire:model="name" label="Name do cargo *" />
            </div>

            <div class="col-span-12 flex justify-center">
                <x-button wire:target="save" wire:click="save" text="Criar cargo" icon="check"
                    loading />
            </div>
        </div>
    </x-admin.content-card>

</x-admin.page>
