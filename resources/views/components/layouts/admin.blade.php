<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }} Admin</title>
    <x-layouts.partials.seo :seo="$seo ?? null" />

    <tallstackui:script />
    @vite('resources/css/admin/app.css')
</head>

<body class="">
    <x-layouts.wrappers.layout>
        <x-layouts.wrappers.aside mini>

            <div class="bg-zinc-950 w-full h-screen overflow-y-auto text-zinc-300"
                :class="{
                    'px-3 py-3': asideMiniOn,
                    'px-6 py-4': !asideMiniOn,
                }">

                {{-- profile --}}
                <div class="flex justify-center items-center gap-4 bg-zinc-900 px-5 py-3 rounded-md cursor-default">
                    <x-avatar :model="\Auth::user()" property="first_name" md />
                    <div x-show="!asideMiniOn" class="truncate">
                        <div class="font-semibold text-base">
                            {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}
                        </div>
                        <div class="text-sm text-zinc-500">
                            {{ \Auth::user()->email }}
                        </div>
                    </div>
                </div>

            </div>

        </x-layouts.wrappers.aside>

        <x-layouts.wrappers.section header-height="60">
            <x-slot name="header">
                <div class="flex w-full px-5">

                    {{-- aside toggler --}}
                    <x-layouts.wrappers.aside-toggler class="ml-auto" />
                </div>
            </x-slot>

            <div class="px-5 py-6 bg-zinc-100 flex-1">
                {{ $slot }}
            </div>
        </x-layouts.wrappers.section>
    </x-layouts.wrappers.layout>
</body>

</html>
