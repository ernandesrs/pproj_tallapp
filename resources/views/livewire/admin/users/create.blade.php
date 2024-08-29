<x-admin.page
    title="Novo usuário">
    <x-admin.content-card class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            @include('livewire.admin.users.partials.basic-data-fields')

            <div class="col-span-12 flex flex-col gap-5 justify-center items-center">
                <x-checkbox wire:model="send_confirmation_email">
                    <x-slot:label>
                        Enviar e-mail de confirmação
                    </x-slot:label>
                </x-checkbox>

                <x-button wire:target="save" wire:click="save" text="Criar usuário" icon="user-plus"
                    loading />
            </div>
        </div>
    </x-admin.content-card>
</x-admin.page>
