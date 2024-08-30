<x-admin.page
    hide-header
    title="Visão geral">

    @can('viewAny', \App\Models\User::class)
        <x-admin.overview-card
            class="col-span-12 sm:col-span-6 lg:col-span-4"
            icon="users-group"
            title="Usuários"
            :value="\App\Models\User::count()"
            :links="[
                [
                    'text' => 'Gerenciar',
                    'icon' => 'settings',
                    'href' => route('admin.users.index'),
                ],
            ]" />
    @endcan

    @can('viewAny', \App\Models\Role::class)
        <x-admin.overview-card
            class="col-span-12 sm:col-span-6 lg:col-span-4"
            icon="shield-half"
            title="Cargos"
            :value="\App\Models\Role::count()"
            :links="[
                [
                    'text' => 'Gerenciar',
                    'icon' => 'settings',
                    'href' => route('admin.roles.index'),
                ],
            ]" />
    @endcan

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="settings"
        title="Dolorem card"
        :value="198"
        :links="[
            [
                'text' => 'Lorem link',
                'icon' => 'settings',
                'href' => '#',
            ],
        ]" />

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="settings"
        title="Dolorem card"
        :value="198"
        :links="[
            [
                'text' => 'Lorem link',
                'icon' => 'settings',
                'href' => '#',
            ],
        ]" />

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="settings"
        title="Dolorem card"
        :value="198"
        :links="[
            [
                'text' => 'Lorem link',
                'icon' => 'settings',
                'href' => '#',
            ],
        ]" />

    <x-admin.overview-card
        class="col-span-12 sm:col-span-6 lg:col-span-4"
        icon="settings"
        title="Dolorem card"
        :value="198"
        :links="[
            [
                'text' => 'Lorem link',
                'icon' => 'settings',
                'href' => '#',
            ],
        ]" />

</x-admin.page>
