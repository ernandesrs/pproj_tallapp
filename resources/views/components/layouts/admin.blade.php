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
    <x-layouts.wrappers.layout>
        <x-layouts.wrappers.aside mini>

            <div class="bg-zinc-900 dark:bg-zinc-950 w-full h-screen overflow-y-auto text-zinc-300"
                :class="{
                    'px-3 py-4': asideMiniOn,
                    'px-6 py-4': !asideMiniOn,
                }">

                {{-- profile --}}
                <div
                    class="flex justify-center items-center gap-4 bg-zinc-800 dark:bg-zinc-900 px-5 py-3 rounded-md cursor-default overflow-hidden">
                    <x-avatar :model="\Auth::user()" property="first_name" md />

                    <x-transitions.fade
                        on-enter-only
                        x-show="!asideMiniOn">
                        <div x-show="!asideMiniOn" class="truncate">
                            <div class="font-semibold text-base">
                                {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}
                            </div>
                            <div class="text-sm text-zinc-500">
                                {{ \Auth::user()->email }}
                            </div>
                        </div>
                    </x-transitions.fade>
                </div>

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
                            'route' => ['name' => 'admin.users.index'],
                            'activeIn' => ['admin.users.index'],
                        ],
                        [
                            'icon' => 'shield-half',
                            'text' => 'Cargos',
                            'permissions' => [\App\Enums\Roles\Permissions\RolePermissionsEnum::VIEW_ANY],
                            'route' => ['name' => 'admin.roles.index'],
                            'activeIn' => ['admin.roles.index'],
                        ],
                        [
                            'icon' => 'user-circle',
                            'text' => 'Meu perfil',
                            'route' => ['name' => 'account.profile'],
                            'activeIn' => ['account.profile'],
                        ],
                    ]" />
                </x-layouts.partials.admin.sidebar-section>

                <x-layouts.partials.admin.sidebar-section
                    title="Others">
                    CONTENT
                </x-layouts.partials.admin.sidebar-section>

            </div>

        </x-layouts.wrappers.aside>

        <x-layouts.wrappers.section header-height="60">
            <x-slot name="header">
                <div class="flex items-center w-full h-full px-5 shadow-sm border-b dark:border-zinc-700">

                    <div class="flex gap-x-6 items-center ml-auto">
                        {{-- theme toggler --}}
                        <x-theme-switch md />

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
