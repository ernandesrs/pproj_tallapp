<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }}</title>
    <x-layouts.partials.seo :seo="$seo ?? null" />

    <tallstackui:script />
    @vite('resources/css/front/app.css')
</head>

<body class="bg-zinc-100 w-full h-screen flex justify-center items-center flex-wrap">
    <x-toast />

    <div class="w-full max-w-[775px] p-6">
        <x-card>
            <h1 class="text-zinc-700 mb-6 text-xl md:text-2xl lg:text-3xl font-medium text-center">
                {{ $title }}
            </h1>
            <div class="flex justify-center">
                {{ $slot }}
            </div>

            @isset($footer)
                <x-slot:footer>
                    {{ $footer }}
                </x-slot:footer>
            @endisset
        </x-card>
    </div>

</body>

</html>
