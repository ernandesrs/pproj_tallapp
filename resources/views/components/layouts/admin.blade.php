<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }} Admin</title>
    <x-layouts.includes.seo :seo="$seo ?? null" />

    <tallstackui:script />
    @vite('resources/css/admin/app.css')
</head>

<body class="">
    <x-layouts.wrappers.layout>
        <x-layouts.wrappers.aside mini>

            <div class="bg-zinc-950 w-full h-full text-zinc-300"
                :class="{
                    'px-3 py-3': asideInMiniMode,
                    'px-6 py-4': !asideInMiniMode,
                }">

                {{-- profile --}}
                <div class="flex justify-center items-center gap-4 bg-zinc-900 px-5 py-3 rounded-md cursor-default">
                    <x-avatar image="https://aj.dev.br/assets/images/aj.jpg" />
                    <div x-show="!asideInMiniMode" class="truncate">
                        <div class="font-semibold text-lg">Ernandes R Souza</div>
                        <div class="text-base text-zinc-500">mail@mail.com</div>
                    </div>
                </div>
            </div>

        </x-layouts.wrappers.aside>

        <x-layouts.wrappers.section>
            <x-slot name="header">
                HEADER
            </x-slot>

            {{ $slot }}
        </x-layouts.wrappers.section>
    </x-layouts.wrappers.layout>
</body>

</html>
