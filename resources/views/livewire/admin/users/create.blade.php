<x-admin.page
    :page="$page">
    <x-admin.content-card class="col-span-12">
        <x-admin.form
            submit-method="save"
            submit-button-icon="user-plus"
            submit-button-text="Salvar usuário"
            class="grid-cols-12">
            @include('livewire.admin.users.partials.basic-data-fields')

            <div class="col-span-12 flex flex-col gap-5 justify-center items-center">
                <x-checkbox wire:model="send_confirmation_email">
                    <x-slot:label>
                        Enviar e-mail de confirmação
                    </x-slot:label>
                </x-checkbox>
            </div>
        </x-admin.form>
    </x-admin.content-card>
</x-admin.page>
