<x-admin.page
    title="Novo cargo">

    <x-admin.content-card class="col-span-12">
        <x-admin.form
            submit-method="save"
            submit-button-text="Criar cargo">
            @include('livewire.admin.roles.partials.role-fields', ['role' => null])
        </x-admin.form>
    </x-admin.content-card>

</x-admin.page>
