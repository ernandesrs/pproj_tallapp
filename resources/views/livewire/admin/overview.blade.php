<x-admin.page
    hide-header
    title="Visão geral">

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="users-group"
        title="Usuários"
        :value="\App\Models\User::count()" />


    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="shield-half"
        title="Cargos"
        :value="\App\Models\Role::count()" />

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="shield-check"
        title="Permissões"
        :value="\App\Models\Permission::count()" />

</x-admin.page>
