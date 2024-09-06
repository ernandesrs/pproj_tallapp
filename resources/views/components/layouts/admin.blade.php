<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="tallstackui_darkTheme()"
    x-bind:class="{
        'dark bg-zinc-900 text-zinc-300': darkTheme,
        'bg-zinc-200 text-zinc-700': !darkTheme
    }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }} Admin</title>
    <x-layouts.partials.seo :seo="$seo ?? null" />

    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo-light.svg') }}" type="image/x-icon">

    <tallstackui:script />
    @vite('resources/css/admin/app.css')
</head>

<body class="">

    <x-toast />
    <x-dialog />

    <x-layouts.wrappers.layout>
        <x-layouts.wrappers.aside mini>

            <div class="bg-zinc-900 dark:bg-zinc-950 w-full h-screen overflow-y-auto text-zinc-300"
                :class="{
                    'px-3 py-2': asideMiniOn,
                    'px-6 py-2': !asideMiniOn,
                }">

                <x-layouts.partials.admin.sidebar-section
                    title="Dashboard">
                    <x-layouts.partials.admin.sidebar-nav :items="[
                        [
                            'icon' => 'chart-pie',
                            'text' => 'Visão geral',
                            'route' => ['name' => 'admin.overview'],
                            'activeIn' => ['admin.overview'],
                        ],
                        [
                            'icon' => 'users-group',
                            'text' => 'Usuários',
                            'permissions' => [\App\Enums\Roles\Permissions\UserPermissionsEnum::VIEW_ANY],
                            'activeIn' => [
                                'admin.users.index',
                                'admin.users.admins',
                                'admin.users.create',
                                'admin.users.show',
                                'admin.users.edit',
                            ],
                            'items' => [
                                [
                                    'icon' => 'users-group',
                                    'text' => 'Todos',
                                    'route' => ['name' => 'admin.users.index'],
                                    'activeIn' => ['admin.users.index'],
                                    'permissions' => [\App\Enums\Roles\Permissions\UserPermissionsEnum::VIEW_ANY],
                                ],
                                [
                                    'icon' => 'user-shield',
                                    'text' => 'Administradores',
                                    'route' => ['name' => 'admin.users.admins'],
                                    'activeIn' => ['admin.users.admins'],
                                    'permissions' => [
                                        \App\Enums\Roles\Permissions\UserPermissionsEnum::UPDATE_ADMIN,
                                        \App\Enums\Roles\Permissions\UserPermissionsEnum::DELETE_ADMIN,
                                    ],
                                ],
                                [
                                    'icon' => 'user-plus',
                                    'text' => 'Criar usuário',
                                    'route' => ['name' => 'admin.users.create'],
                                    'activeIn' => ['admin.users.create'],
                                    'permissions' => [\App\Enums\Roles\Permissions\UserPermissionsEnum::CREATE],
                                ],
                            ],
                        ],
                        [
                            'icon' => 'shield-half',
                            'text' => 'Cargos',
                            'permissions' => [\App\Enums\Roles\Permissions\RolePermissionsEnum::VIEW_ANY],
                            'route' => ['name' => 'admin.roles.index'],
                            'activeIn' => ['admin.roles.index', 'admin.roles.create', 'admin.roles.edit'],
                        ]
                    ]" />
                </x-layouts.partials.admin.sidebar-section>

                <x-layouts.partials.admin.sidebar-section
                    title="Outros">
                    <x-layouts.partials.admin.sidebar-nav :items="[
                        [
                            'icon' => 'user-circle',
                            'text' => 'Meu perfil',
                            'route' => ['name' => 'account.profile'],
                            'activeIn' => ['account.profile'],
                        ],
                    ]" />
                </x-layouts.partials.admin.sidebar-section>

            </div>

        </x-layouts.wrappers.aside>

        <x-layouts.wrappers.section header-height="60">
            <x-slot name="header">
                <div class="flex items-center w-full h-full px-5 shadow-sm border-b dark:border-zinc-700">

                    <div class="flex gap-x-6 items-center ml-auto">

                        {{-- profile dropdown --}}
                        <x-dropdown>
                            <x-slot:action>
                                <div x-on:click="show = !show"
                                    class="cursor-pointer flex items-center gap-x-2 px-3 py-2 rounded-md bg-zinc-100 dark:bg-zinc-800">
                                    @php
                                        $authUser = \Auth::user();
                                    @endphp
                                    <x-admin.custom-avatar :avatar="$authUser->avatar" text="{{ $authUser->first_name }}" xs />
                                </div>
                            </x-slot:action>

                            <div class="p-5 flex flex-col items-center justify-center">
                                <x-avatar :image="$authUser->avatar
                                    ? (\Str::startsWith($authUser->avatar, ['http://', 'https://'])
                                        ? $authUser->avatar
                                        : \Storage::url($authUser->avatar))
                                    : null" text="{{ $authUser->first_name }}" lg />

                                <div class="w-[90%] text-center mt-3">
                                    <div class="truncate text-lg">
                                        {{ $authUser->first_name }} {{ $authUser->last_name }}
                                    </div>
                                    <div class="truncate text-base text-zinc-400 dark:text-zinc-300">
                                        {{ $authUser->email }}
                                    </div>
                                </div>
                            </div>

                            <x-dropdown.items wire:navigate href="{{ route('account.profile') }}" icon="user-circle"
                                text="Meu perfil" separator />

                            <x-dropdown.items icon="arrow-right" text="Dropdown #1" separator />

                            <div class="p-5 flex flex-wrap justify-between items-center">
                                {{-- theme toggler --}}
                                <x-theme-switch lg />

                                <x-button wire:navigate href="{{ route('auth.logout') }}" icon="logout"
                                    text="Deslogar" color="rose" sm />
                            </div>
                        </x-dropdown>

                        {{-- aside toggler --}}
                        <x-layouts.wrappers.aside-toggler />
                    </div>
                </div>
            </x-slot>

            <div class="px-5 py-6 flex-1">
                {{ $slot }}
            </div>
        </x-layouts.wrappers.section>
    </x-layouts.wrappers.layout>
</body>

</html>
